<?php

namespace App\Models;

use App\Utils\Status;
use Illuminate\Support\Facades\Config;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

/**
 * @method static firstOrFail()
 */
class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'settings';
    protected $appends = [
        'authLogo',
        'brandLogo',
        'brandIcon'
    ];
    public const PAYPAL_BASE_URL = [
        'sandbox' => 'https://api-m.sandbox.paypal.com',
        'production' => 'https://api-m.paypal.com',
    ];
    public const PP_ENV_SELECT = [
        'sandbox' => 'Sandbox',
        'production' => 'Production',
    ];

    public const LOCALE = 'locale_id';
    public const THEME = 'theme_id';
    public const YEARLY_PLAN = 'yearly_plan';

    public const YEARLY_PLAN_SELECT = [
        Status::ENABLED => 'Enabled',
        Status::DISABLED => 'Disabled',
    ];

    public const STRIPE = 'Stripe';
    public const PAYPAL = 'PayPal';

    public const PAYMENT_METHOD_SELECT = [
        self::STRIPE,
        self::PAYPAL
    ];

    protected $casts = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'key',
        'value',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function saveByKey($key, $value)
    {
        $setting = self::firstOrNew(['key' => $key]);
        $setting->value = $value;
        $setting->created_by = User::STATIC_ADMIN_DATABASE_ID;
        $setting->save();


        if ($key == 'stripe_key') {
            Config::set('cashier.key', $value);
        }
        if ($key == 'stripe_secret') {
            Config::set('cashier.secret', $value);
        }
        if ($key == 'stripe_webhook_secret') {
            Config::set('cashier.webhook.secret', $value);
        }
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getAuthLogoAttribute()
    {
        $file = $this->getMedia('auth-logo')->last();
        if ($file) {
            $file->url = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview = $file->getUrl('preview');
        }
        return $file;
    }

    public function getBrandLogoAttribute()
    {
        $file = $this->getMedia('brand-logo')->last();
        if ($file) {
            $file->url = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview = $file->getUrl('preview');
        }
        return $file;
    }

    public function getBrandIconAttribute()
    {
        $file = $this->getMedia('brand-favicon')->last();
        if ($file) {
            $file->url = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview = $file->getUrl('preview');
        }
        return $file;
    }
}
