<?php

// phpcs:disable Generic.Files.LineLength.TooLong
return array(
    'userManagement' => array(
        'title' => 'User management',
        'title_singular' => 'User management',
    ),
    'permission' => array(
        'title' => 'Permissions',
        'title_singular' => 'Permission',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'role' => array(
        'title' => 'Roles',
        'title_singular' => 'Role',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'permissions' => 'Permissions',
            'permissions_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'user' => array(
        'title' => 'Users',
        'title_singular' => 'User',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'email' => 'Email',
            'email_helper' => ' ',
            'language' => 'Preferred Output Language',
            'language_helper' => ' ',
            'email_verified_at' => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password' => 'Password',
            'password_helper' => ' ',
            'roles' => 'Roles',
            'roles_helper' => ' ',
            'remember_token' => 'Remember Token',
            'remember_token_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'theme' => 'Theme',
            'theme_helper' => ' ',
        ),
    ),
    'category' => array(
        'title' => 'Categories',
        'title_singular' => 'Category',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'status' => 'Status',
            'status_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'prompt' => array(
        'title' => 'Prompts',
        'title_singular' => 'Prompt',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'type' => 'Type',
            'type_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'prompt' => 'Prompt',
            'prompt_helper' => ' ',
            'max_tokens' => 'Max Tokens',
            'max_tokens_helper' => 'If not set, default max-tokens set in third-party settings will be used.',
            'category' => 'Category',
            'category_helper' => ' ',
            'tone' => 'Default Tone',
            'tone_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'question' => 'Questions',
            'question_helper' => ' ',
            'description' => 'Description',
            'description_helper' => ' ',
            'chat_bot_helper' => ' ',
            'chat_bot' => 'Persona',
            'engine' => 'Engine',
            'engine_helper' => 'If not set, default engine set in third-party settings will be used.',
            'status' => 'Status',
            'status_helper' => ' ',
        ),
    ),
    'question' => array(
        'title' => 'Questions',
        'title_singular' => 'Question',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'question' => 'Question',
            'question_helper' => ' ',
            'type' => 'Type',
            'type_helper' => ' ',
            'is_required' => 'Required',
            'is_required_helper' => ' ',
            'minimum_answer_length' => 'Minimum Answer Length',
            'minimum_answer_length_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'options' => 'Options',
            'options_helper' => '',
        ),
        'new_question' => 'New question',
    ),
    'content' => array(
        'title' => 'Content',
        'title_singular' => 'Content',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'prompt' => 'Prompt',
            'prompt_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'tone' => 'Tone',
            'tone_helper' => ' ',
            'engine' => 'Tone',
            'engine_helper' => ' ',
            'language' => 'Language',
            'language_helper' => ' ',
            'user' => 'User',
            'user_helper' => ' ',
            'outputs_count' => 'Outputs Count',
            'outputs_count_helper' => ' ',
            'content' => 'Content',
            'content_helper' => ' ',
        ),
    ),
    'tone' => array(
        'title' => 'Tones',
        'title_singular' => 'Tone',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'tone' => 'Tone',
            'tone_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'answer' => array(
        'title' => 'Answers',
        'title_singular' => 'Answer',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'question' => 'Question',
            'question_helper' => ' ',
            'content' => 'Content',
            'content_helper' => ' ',
            'answer' => 'Answer',
            'answer_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'auditLog' => array(
        'title' => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'description' => 'Description',
            'description_helper' => ' ',
            'subject_id' => 'Subject ID',
            'subject_id_helper' => ' ',
            'subject_type' => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id' => 'User ID',
            'user_id_helper' => ' ',
            'properties' => 'Properties',
            'properties_helper' => ' ',
            'host' => 'Host',
            'host_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
        ),
    ),
    'paymentMethod' => array(
        'title' => 'Payment Methods',
        'title_singular' => 'Payment Method',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'is_enabled' => 'Enabled',
            'is_enabled_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'currency' => array(
        'title' => 'Currencies',
        'title_singular' => 'Currency',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'code' => 'Code',
            'code_helper' => ' ',
            'symbol' => 'Symbol',
            'symbol_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'plan' => array(
        'title' => 'Plans',
        'title_singular' => 'Plan',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'description' => 'Description',
            'description_helper' => ' ',
            'price_monthly' => 'Price (Monthly)',
            'pp_monthly_plan' => 'PayPal Monthly Plan Id',
            'pp_monthly_plan_helper' => '',
            'pp_yearly_plan' => 'PayPal Yearly Plan Id',
            'pp_yearly_plan_helper' => '',
            'stripe_monthly_plan' => 'Stripe Monthly Plan Id',
            'stripe_monthly_plan_helper' => '',
            'stripe_yearly_plan' => 'Stripe Yearly Plan Id',
            'stripe_yearly_plan_helper' => '',
            'price_monthly_helper' => ' ',
            'price_yearly' => 'Price (Yearly)',
            'price_yearly_helper' => ' ',
            'type' => 'Type',
            'type_helper' => ' ',
            'word_limit' => 'Word Limit',
            'word_limit_helper' => ' ',
            'image_limit' => 'Image Limit',
            'image_limit_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'seats_limit' => 'Seats Limit',
            'seats_limit_helper' => ' ',
            'features' => 'Features',
            'features_helper' => '',
        ),
    ),
    'subscription' => array(
        'title' => 'Subscriptions',
        'title_singular' => 'Subscription',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'user' => 'User',
            'user_helper' => ' ',
            'plan' => 'Plan',
            'plan_helper' => ' ',
            'start_at' => 'Start At',
            'start_at_helper' => ' ',
            'end_at' => 'End At',
            'end_at_helper' => ' ',
            'canceled_at' => 'Canceled At',
            'canceled_at_helper' => ' ',
            'status' => 'Status',
            'status_helper' => ' ',
            'payment_frequency' => 'Payment Frequency',
            'payment_frequency_helper' => ' ',
            'pp_subscription' => 'PayPal Subscription Id',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'payment' => array(
        'title' => 'Payments',
        'title_singular' => 'Payment',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'user' => 'User',
            'user_helper' => ' ',
            'currency' => 'Currency',
            'currency_helper' => ' ',
            'payment_method' => 'Payment Method',
            'payment_method_helper' => ' ',
            'subscription' => 'Subscription',
            'subscription_helper' => ' ',
            'amount' => 'Amount',
            'amount_helper' => ' ',
            'status' => 'Status',
            'status_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'paymentManagement' => array(
        'title' => 'Payment Management',
        'title_singular' => 'Payment Management',
    ),
    'subscriptionManagement' => array(
        'title' => 'Subscription Management',
        'title_singular' => 'Subscription Management',
    ),
    'setting' => array(
        'title' => 'Settings',
        'title_singular' => 'Settings',
        'auth_log_settings' => 'Auth Logo',
        'payment_settings' => 'Payment Settings',
        'currency_settings' => 'Currency Settings',
        'content_settings' => 'Content Settings',
        'content' => 'Content',
        'subscriptions_settings' => 'Subscriptions Settings',
        'customize_colors' => 'Customize colors',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'currency' => 'Active Currency',
            'currency_helper' => ' ',
            'yearly_plan' => 'Yearly Plan',
            'yearly_plan_helper' => 'Enables/Disables customers to buy yearly plan',
            'language' => 'Default Language',
            'language_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'locale' => 'Default Locale',
            'locale_helper' => ' ',
            'theme' => 'Default Theme',
            'theme_helper' => ' ',
            'auth_logo_helper' => ' ',
        ),
        'locale_settings' => 'Locale Settings',
        'theme_settings' => 'Theme Settings',
        'google_call_back_url' => 'Google Callback URL',
        'google_setting' => 'Google Settings',
        'google_client_id' => 'Google Client ID',
        'google_client_secret' => 'Google Client Secret',
        'login_by_google' => 'Enable login with Google',
        'default_currency' => 'Default Currency',
        'enable_pp_payment' => 'Enable payment with PayPal',
        'enable_stripe_payment' => 'Enable payment with Stripe',
        'custom_scripts' => 'Custom scripts',
        'head_script' => 'Head scripts',
        'body_script' => 'Body scripts',
        'head_script_helper' => '',
        'body_script_helper' => '',
        'default_colors' => 'Default Colors',
        'primary_color' => 'Primary',
        'secondary_color' => 'Secondary',
        'success_color' => 'Success',
        'info_color' => 'Info',
        'warning_color' => 'Warning',
        'danger_color' => 'Danger',
        'dark_color' => 'Dark',
        'primary_color_helper' => '',
        'secondary_color_helper' => '',
        'success_color_helper' => '',
        'info_color_helper' => '',
        'warning_color_helper' => '',
        'danger_color_helper' => '',
        'dark_color_helper' => '',
    ),
    'brand' => array(
        'title' => 'Brand',
        'title_singular' => 'Brand',
        'brand_settings' => 'Brand settings',
        'social_media_links' => 'Social media links',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'site_title' => 'Site Title',
            'site_title_helper' => ' ',
            'slogan' => 'Slogan',
            'slogan_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'logo' => 'Logo',
            'logo_helper' => 'Recommended size 240 x 72 px',
            'email' => 'Email',
            'email_helper' => ' ',
            'address' => 'Address',
            'address_helper' => ' ',
            'phone' => 'Phone',
            'phone_helper' => ' ',
            'version' => 'Version',
            'version_helper' => ' ',
            'favicon' => 'Favicon',
            'favicon_helper' => ' ',
            'facebook' => 'Facebook',
            'facebook_helper' => ' ',
            'instagram' => 'Instagram',
            'instagram_helper' => ' ',
            'twitter' => 'Twitter',
            'twitter_helper' => ' ',
            'youtube' => 'YouTube',
            'youtube_helper' => ' ',
            'google' => 'Google',
            'google_helper' => ' ',
            'tiktok' => 'TikTok',
            'tiktok_helper' => ' ',
            'linkedin' => 'LinkedIn',
            'linkedin_helper' => ' ',
            'auth_logo' => 'Onboarding background image',
        ),
    ),
    'thirdParty' => array(
        'title' => 'Third Party',
        'title_singular' => 'Third Party',
        'chat_settings' => 'Chat settings',
        'chat_engine_model' => 'Default Model',
        'chatbot' => 'Persona',
        'openai_settings' => 'OpenAI Settings',
        'paypal_settings' => 'PayPal Settings',
        'stripe_settings' => 'Stripe Settings',
        'rewardful_settings' => 'Affiliate',
        'rewardful_instructions' => 'Rewardful integration instructions',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'default_max_tokens' => 'Default Max Tokens',
            'default_max_tokens_helper' => 'Use this calculator https://platform.openai.com/tokenizer to get ' .
                'accurate estimation',
            'engine' => 'Default Engine',
            'engine_helper' => '',
            'openai_api_key' => 'OpenAI Api Key',
            'openai_api_key_helper' => ' ',
            'pp_client' => 'PayPal Client ID',
            'pp_client_helper' => ' ',
            'pp_secret' => 'PayPal Secret',
            'pp_secret_helper' => ' ',
            'pp_env' => 'PayPal Environment',
            'pp_env_helper' => ' ',
            'stripe_key' => 'Stripe Key',
            'stripe_key_helper' => ' ',
            'stripe_secret' => 'Stripe Secret',
            'stripe_secret_helper' => ' ',
            'stripe_webhook_secret' => 'Stripe Webhook Secret',
            'stripe_webhook_secret_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'pp_webhook_secret_helper' => ' ',
            'pp_webhook_secret' => 'PayPal Webhook Secret',
            'rewardful_key' => 'Rewardful Key',
        ),
    ),
    'customize' => array(
        'title' => 'Customize',
        'title_singular' => 'Customize',
    ),
    'hero' => array(
        'title' => 'Hero',
        'title_singular' => 'Hero',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'subtitle' => 'Subtitle',
            'subtitle_helper' => ' ',
            'image' => 'Image',
            'image_helper' => 'Recommended size 1098 x 740 px',
            'cta' => 'Call To Action',
            'cta_helper' => ' ',
            'promotion' => 'Promotion',
            'promotion_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'partner' => array(
        'title' => 'Partners',
        'title_singular' => 'Partner',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'url' => 'Url',
            'url_helper' => ' ',
            'logo' => 'Logo',
            'logo_helper' => 'Recommended size 140 x 47 px',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'landingPage' => array(
        'title' => 'Landing Page',
        'title_singular' => 'Landing Page',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'hero' => 'Hero',
            'hero_helper' => ' ',
            'partners' => 'Partners',
            'partners_helper' => ' ',
            'story' => 'Story',
            'story_helper' => ' ',
            'pricing' => 'Pricing',
            'pricing_helper' => ' ',
            'testimonial' => 'Testimonial',
            'testimonial_helper' => ' ',
        ),
    ),
    'story' => array(
        'title' => 'Story',
        'title_singular' => 'Story',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'subtitle' => 'Subtitle',
            'subtitle_helper' => ' ',
            'promotion' => 'Promotion',
            'promotion_helper' => ' ',
            'browser_image' => 'Browser Image',
            'browser_image_helper' => 'Recommended size 1618 x 1010 px',
            'phone_image' => 'Phone Image',
            'phone_image_helper' => 'Recommended size 407 x 867 px',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'block' => 'Blocks',
            'block_helper' => ' ',
        ),
    ),
    'pricing' => array(
        'title' => 'Pricing',
        'title_singular' => 'Pricing',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'subtitle' => 'Subtitle',
            'subtitle_helper' => ' ',
            'promotion' => 'Promotion',
            'promotion_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'testimonial' => array(
        'title' => 'Testimonials',
        'title_singular' => 'Testimonial',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'avatar' => 'Avatar',
            'avatar_helper' => 'Recommended size 514 x 440 px',
            'review' => 'Review',
            'review_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'block' => array(
        'title' => 'Blocks',
        'title_singular' => 'Block',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'icon' => 'Icon',
            'icon_helper' => 'Recommended size 68 x 68 px',
            'title' => 'Title',
            'title_helper' => ' ',
            'subtitle' => 'Subtitle',
            'subtitle_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'engine' => array(
        'title' => 'Engines',
        'title_singular' => 'Engine',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'type' => 'Type',
            'type_helper' => 'Use Chat completion type for GPT3.5 and GPT4',
            'title' => 'Title',
            'title_helper' => ' ',
            'value' => 'Value',
            'value_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'language' => array(
        'title' => 'Languages',
        'title_singular' => 'Language',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'language' => 'Language',
            'language_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'footer' => array(
        'title' => 'Footer',
        'title_singular' => 'Footer',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'copyrights' => 'Copyrights',
            'copyrights_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'disclaimer' => 'Disclaimer',
            'disclaimer_helper' => ' ',
        ),
    ),
    'dashboardSetting' => array(
        'title' => 'User dashboard',
        'title_singular' => 'User dashboard',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'subtitle' => 'Subtitle',
            'subtitle_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
            'image' => 'Image',
            'image_helper' => 'Recommended size 1351 × 1076 px',
        ),
    ),
    'contentManagement' => array(
        'title' => 'Content management',
        'title_singular' => 'Content management',
    ),
    'contentCategory' => array(
        'title' => 'Categories',
        'title_singular' => 'Category',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'slug' => 'Slug',
            'slug_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted At',
            'deleted_at_helper' => ' ',
        ),
    ),
    'contentTag' => array(
        'title' => 'Tags',
        'title_singular' => 'Tag',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'name' => 'Name',
            'name_helper' => ' ',
            'slug' => 'Slug',
            'slug_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted At',
            'deleted_at_helper' => ' ',
        ),
    ),
    'contentPage' => array(
        'title' => 'Pages',
        'title_singular' => 'Page',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'category' => 'Categories',
            'category_helper' => ' ',
            'tag' => 'Tags',
            'tag_helper' => ' ',
            'page_text' => 'Full Text',
            'page_text_helper' => ' ',
            'excerpt' => 'Excerpt',
            'excerpt_helper' => ' ',
            'featured_image' => 'Featured Image',
            'featured_image_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted At',
            'deleted_at_helper' => ' ',
        ),
    ),
    'locale' => array(
        'title' => 'Locales',
        'title_singular' => 'Locale',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'slug' => 'Slug',
            'slug_helper' => ' ',
            'flag_name' => 'Flag Name',
            'flag_name_helper' => ' ',
            'status' => 'Status',
            'status_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'page' => array(
        'title' => 'Pages',
        'title_singular' => 'Page',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'theme' => 'Theme',
            'theme_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'theme' => array(
        'title' => 'Themes',
        'title_singular' => 'Theme',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'section' => array(
        'title' => 'Sections',
        'title_singular' => 'Section',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'title' => 'Title',
            'title_helper' => ' ',
            'description' => 'Description',
            'description_helper' => ' ',
            'image' => 'Image',
            'image_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'component' => array(
        'title' => 'Components',
        'title_singular' => 'Component',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'type' => 'Type',
            'type_helper' => ' ',
            'content' => 'Content',
            'content_helper' => ' ',
            'image' => 'Image',
            'image_helper' => ' ',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
    'general' => array(
        'title' => 'General',
        'title_singular' => 'General Settings',
        'fields' => array(
            'key' => 'Key',
            'value' => 'Value',
            'key_helper' => ' ',
            'value_helper' => ' ',
        ),
    ),
    'invoice' => array(
        'title' => 'Invoices',
        'title_singular' => 'Invoice',
        'receipt_number' => 'Receipt number',
        'date_paid' => 'Date paid',
        'creativeAI' => 'CreativeAI',
        'bill_to' => 'Bill to',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'user_id' => 'User',
            'payment_method_id' => 'Payment method',
            'date' => 'Date',
            'number' => 'Invoice number',
            'discount' => 'Discount',
            'amount' => 'Amount',
            'notes' => 'Notes',
            'url_key' => 'Invoice key',
        ),
    ),
    'invoice_item' => array(
        'title' => 'Items',
        'title_singular' => 'Items',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'invoice_id' => 'Invoice',
            'plan_id' => 'Plan',
            'price' => 'Unit Price',
            'quantity' => 'Qty',
            'description' => 'Description',
        ),
    ),
    'chat_bots' => array(
        'title' => 'Personas',
        'title_singular' => 'Persona',
        'chat_bot_settings' => 'Persona Settings',
        'new_chatbot_success' => 'Persona has been created successfully',
        'delete_chatbot_success' => 'Persona has been deleted successfully',
        'update_chatbot_success' => 'Persona has been updated successfully',
        'files' => 'Files',
        'sources' => 'Sources',
        'included_files' => 'Already Included Files',
        'fields' => array(
            'id' => 'ID',
            'id_helper' => ' ',
            'site_url' => 'Website',
            'type_helper' => '',
            'title' => 'Title',
            'title_helper' => '',
            'text' => 'Text',
            'files' => 'Upload Files',
            'files_helper' => 'Drag & drop files here, or click to select files Supported File Types: .pdf, ' .
                '.doc, .docx, .txt, .csv',
            'text_helper' => '',
            'site_url_helper' => '',
            'select_file' => 'Please select file',
            'created_at' => 'Created at',
            'created_at_helper' => ' ',
            'updated_at' => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at' => 'Deleted at',
            'deleted_at_helper' => ' ',
        ),
    ),
);
