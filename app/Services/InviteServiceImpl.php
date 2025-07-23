<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InvalidInvitationException;
use App\Exceptions\TokenExpiredException;
use App\Exceptions\UserAlreadyInvitedException;
use App\Exceptions\UserDeactivatedException;
use App\Models\Invite;
use App\Models\Team;
use App\Models\User;
use App\Notifications\InviteMemberNotification;
use App\Repository\Auth\UserRepository;
use App\Repository\Invite\InviteRepository;
use App\Utils\ActionUrlBuilder;
use App\Utils\Status;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;

class InviteServiceImpl implements InviteService
{
    /**
     * @var InviteRepository
     */
    private $inviteRepository;
    /**
     * @var \App\Repository\Auth\UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @param InviteRepository $inviteRepository
     * @param \App\Repository\Auth\UserRepository $userRepository
     */
    public function __construct(
        InviteRepository $inviteRepository,
        UserRepository $userRepository
    ) {
        $this->inviteRepository = $inviteRepository;
        $this->userRepository = $userRepository;
    }

    public function sendAnInvite(
        int $tenantId,
        int $teamId,
        string $email
    ): void {
        $token = $this->inviteRepository->prepareAndStore(
            $tenantId,
            $teamId,
            $email,
        );

        if (!$token) {
            throw new UserAlreadyInvitedException();
        }

        $sender = auth()->user();

        $this->sendTeamMemberInvite($token, $email, $sender->name);
    }

    /**
     * @param \App\Models\User $user
     * @param User|null $invitedBy
     *
     * @throws \Exception
     */
    public function resendAnInvite(User $user, ?User $invitedBy = null): void
    {
        if (!$user->is_invited) {
            throw new \Exception('Member already exists', Response::HTTP_BAD_REQUEST);
        }

        $invitedBy = $invitedBy ?: auth()->user();

        $token = $this->inviteRepository->prepareAndStore(
            1,
            $user->team_id,
            $user->email
        );

        if (!$token) {
            $token = $this->inviteRepository->findBy('email', $user->email)->token;
        }

        $this->sendTeamMemberInvite(
            $token,
            $user->temp_data['first_name'],
            $user->temp_data['last_name']
        );
    }

    /**
     * @param string $token
     * @param string $email
     * @param string|null $name
     */
    public function sendTeamMemberInvite(
        string $token,
        string $email,
        ?string $name = '',
    ): void {
        $url = ActionUrlBuilder::buildRegisterUrl($token, $email);

        Notification::route('mail', $email)->notify(new InviteMemberNotification($url, $name));
    }

    /**
     * @inheritDoc
     */
    public function deleteExpiredInvites(): void
    {
        $this->inviteRepository->deleteExpired();
    }

    /**
     * @inheritDoc
     */
    public function getExpiredInvites(?array $eager = []): Collection
    {
        return $this->inviteRepository->findExpired($eager);
    }

    /**
     * @inheritDoc
     */
    public function deleteInviteByToken(string $inviteToken, Team $team, User $user): void
    {
        $this->inviteRepository->findBy('token', $inviteToken);

        $this->inviteRepository->deleteBy('token', $inviteToken);
    }

    /**
     * @inheritDoc
     */
    public function deleteInvitesByTeamId(int $teamId): void
    {
        $this->inviteRepository->deleteBy('team_id', $teamId);
    }

    /**
     * @inheritdoc
     */
    public function deleteInvite(int $inviteId): void
    {
        $this->inviteRepository->destroy($inviteId);
    }

    /**
     * @inheritDoc
     */
    public function checkIfUserHasInvite(string $email): bool
    {
        return (bool)$this->inviteRepository->findBy('email', $email);
    }

    /**
     * @inheritDoc
     */
    public function emailHasInviteToCompany(string $email, int $companyId): bool
    {
        return (bool)$this->inviteRepository->findByCompanyIdAndEmail($companyId, $email);
    }

    public function checkIfInviteValid(string $token, string $email): bool
    {
        /** @var Invite $invite */
        $invite = $this->inviteRepository->findBy('token', $token);

        if (!$invite || $this->checkIfInviteExpired($invite)) {
            throw new TokenExpiredException();
        }

        /** @var User $user */
        $user = $this->companyMemberRepository->fresh(
            $this->companyMemberRepository->findBy('email', $email),
            ['company']
        );

        if (!$user || !$user->activity_status) {
            throw new UserDeactivatedException();
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function checkIfInviteExpired(Invite $invite): bool
    {
        return $invite->created_at <= now()->subDays(config('app.invite_duration_in_days'));
    }

    /**
     * @inheritDoc
     */
    public function getInviteFromToken(string $token): ?Invite
    {
        return $this->inviteRepository->findBy('token', $token);
    }

    /**
     * @inheritDoc
     */
    public function getInviteByCompanyIdAndEmail(int $companyId, string $email): ?Invite
    {
        return $this->inviteRepository->findByCompanyIdAndEmail($companyId, $email);
    }

    /**
     * @throws \App\Exceptions\InvalidInvitationException
     */
    public function linkToTeam(string $token, User $user): Invite
    {
        $invite = $this->inviteRepository->allWhereConditions(['status' => Status::OPEN, 'token' => $token])
            ->first();

        if (! $invite) {
            throw new InvalidInvitationException($token);
        }

        // link invitee to inviter team
        $user->teams()->attach($invite->team);
        $invite->team->currentUsers()->save($user);
        // link inviter to invitee team
        $invite->team->owner->teams()->attach($user->ownedTeams->first());

        return $invite;
    }

    public function unlinkTeam(Invite $invite, User $user): Invite
    {
        $inviteUser = $this->userRepository->findBy('email', $invite->email);
        if ($inviteUser) {
            // unlink invitee to inviter team
            $user->teams()->detach($inviteUser->ownedTeams->first());
            // unlink inviter to invitee team
            $inviteUser->teams()->detach($user->ownedTeams->first());
        }

        return $invite;
    }

    public function acceptInvitation(Invite $invite): Invite
    {
        return $this->inviteRepository->acceptInvitation($invite);
    }
}
