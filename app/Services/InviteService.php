<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Invite;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Collection;

interface InviteService
{
    /**
     * Send an invitation to a provided [notifiable]
     *
     * @param int $tenantId
     * @param int $teamId
     * @param string $email
     * @return void
     */
    public function sendAnInvite(
        int $tenantId,
        int $teamId,
        string $email
    ): void;

    /**
     * Delete expired invites
     *
     * @return void
     */
    public function deleteExpiredInvites(): void;

    /**
     * Get expired invites
     *
     * @param array|null $eager
     *
     * @return Collection
     */
    public function getExpiredInvites(?array $eager = []): Collection;

    /**
     * Delete invite for given token and handle invite type
     *
     * @param string $inviteToken
     * @param \App\Models\Team $team
     * @param User $user
     *
     * @return void
     */
    public function deleteInviteByToken(string $inviteToken, Team $team, User $user): void;

    /**
     * Delete invite for given token and handle invite type
     *
     * @param int $teamId
     * @return void
     */
    public function deleteInvitesByTeamId(int $teamId): void;

    /**
     * Delete invite
     *
     * @param int $inviteId
     */
    public function deleteInvite(int $inviteId): void;

    /**
     * Check if user exists in 'invites' table by mail
     *
     * @param string $email
     *
     * @return bool
     */
    public function checkIfUserHasInvite(string $email): bool;

    /**
     * @param string $email
     * @param int $companyId
     * @return bool
     */
    public function emailHasInviteToCompany(string $email, int $companyId): bool;

    /**
     * Check if invite is valid
     *
     * @param string $token
     * @param string $email
     * @return bool
     */
    public function checkIfInviteValid(string $token, string $email): bool;

    /**
     * Check if invite is expired
     *
     * @param Invite $invite
     *
     * @return bool
     */
    public function checkIfInviteExpired(Invite $invite): bool;

    /**
     * Get invite by token
     *
     * @param string $token
     *
     * @return Invite|null
     */
    public function getInviteFromToken(string $token): ?Invite;

    /**
     * @param int $companyId
     * @param string $email
     *
     * @return Invite|null
     */
    public function getInviteByCompanyIdAndEmail(int $companyId, string $email): ?Invite;

    /**
     * @throws \App\Exceptions\InvalidInvitationException
     */
    public function linkToTeam(string $token, User $user): Invite;

    public function unlinkTeam(Invite $invite, User $user): Invite;

    public function acceptInvitation(Invite $invite): Invite;
}
