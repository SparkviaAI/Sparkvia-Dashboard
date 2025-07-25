<?php

// phpcs:disable Generic.Files.LineLength.TooLong
return array(
    'userManagement' => array(
        'title' => 'gerenciamento de usuários',
        'title_singular' => 'gerenciamento de usuários',
    ),
    'permission' => array(
        'title' => 'Permissões',
        'title_singular' => 'Permissão',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'role' => array(
        'title' => 'Funções',
        'title_singular' => 'Papel',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'permissions' => 'Permissões',
            'permissions_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'user' => array(
        'title' => 'Usuários',
        'title_singular' => 'Do utilizador',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'name' => 'Nome',
            'name_helper' => '',
            'email' => 'E-mail',
            'email_helper' => '',
            'language' => 'Idioma de saída preferido',
            'language_helper' => '',
            'email_verified_at' => 'E-mail verificado em',
            'email_verified_at_helper' => '',
            'password' => 'Senha',
            'password_helper' => '',
            'roles' => 'Funções',
            'roles_helper' => '',
            'remember_token' => 'Lembrar token',
            'remember_token_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
            'theme' => 'Tema',
            'theme_helper' => '',
        ),
    ),
    'category' => array(
        'title' => 'Categorias',
        'title_singular' => 'Categoria',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'status' => 'Status',
            'status_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'prompt' => array(
        'title' => 'Comandos',
        'title_singular' => 'Incitar',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'type' => 'Tipo',
            'type_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'prompt' => 'Incitar',
            'prompt_helper' => '',
            'max_tokens' => 'Máximo de fichas',
            'max_tokens_helper' => 'Se não for definido, os tokens máximos padrão definidos nas configurações de terceiros serão usados.',
            'category' => 'Categoria',
            'category_helper' => '',
            'tone' => 'Tom padrão',
            'tone_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
            'question' => 'Questões',
            'question_helper' => '',
            'description' => 'Descrição',
            'description_helper' => '',
            'engine' => 'Motor',
            'engine_helper' => 'Se não for definido, o mecanismo padrão definido nas configurações de terceiros será usado.',
            'status' => 'Status',
            'status_helper' => '',
        ),
    ),
    'question' => array(
        'title' => 'Questões',
        'title_singular' => 'Pergunta',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'question' => 'Pergunta',
            'question_helper' => '',
            'type' => 'Tipo',
            'type_helper' => '',
            'is_required' => 'Obrigatório',
            'is_required_helper' => '',
            'minimum_answer_length' => 'Comprimento mínimo da resposta',
            'minimum_answer_length_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
            'options' => 'Opções',
            'options_helper' => '',
        ),
        'new_question' => 'Nova pergunta',
    ),
    'content' => array(
        'title' => 'Contente',
        'title_singular' => 'Contente',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'prompt' => 'Incitar',
            'prompt_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
            'tone' => 'Tom',
            'tone_helper' => '',
            'engine' => 'Tom',
            'engine_helper' => '',
            'language' => 'Linguagem',
            'language_helper' => '',
            'user' => 'Do utilizador',
            'user_helper' => '',
            'outputs_count' => 'Contagem de Saídas',
            'outputs_count_helper' => '',
            'content' => 'Contente',
            'content_helper' => '',
        ),
    ),
    'tone' => array(
        'title' => 'tons',
        'title_singular' => 'Tom',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'tone' => 'Tom',
            'tone_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'answer' => array(
        'title' => 'Respostas',
        'title_singular' => 'Responder',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'question' => 'Pergunta',
            'question_helper' => '',
            'content' => 'Contente',
            'content_helper' => '',
            'answer' => 'Responder',
            'answer_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'auditLog' => array(
        'title' => 'Registros de auditoria',
        'title_singular' => 'Registro de Auditoria',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'description' => 'Descrição',
            'description_helper' => '',
            'subject_id' => 'ID do assunto',
            'subject_id_helper' => '',
            'subject_type' => 'Tipo de assunto',
            'subject_type_helper' => '',
            'user_id' => 'ID do usuário',
            'user_id_helper' => '',
            'properties' => 'Propriedades',
            'properties_helper' => '',
            'host' => 'Hospedar',
            'host_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
        ),
    ),
    'paymentMethod' => array(
        'title' => 'Métodos de Pagamento',
        'title_singular' => 'Forma de pagamento',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'is_enabled' => 'Habilitado',
            'is_enabled_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'currency' => array(
        'title' => 'Moedas',
        'title_singular' => 'Moeda',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'code' => 'Código',
            'code_helper' => '',
            'symbol' => 'Símbolo',
            'symbol_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'plan' => array(
        'title' => 'Planos',
        'title_singular' => 'Plano',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'description' => 'Descrição',
            'description_helper' => '',
            'price_monthly' => 'Preço (mensal)',
            'pp_monthly_plan' => 'ID do plano mensal do PayPal',
            'pp_monthly_plan_helper' => '',
            'pp_yearly_plan' => 'ID do plano anual do PayPal',
            'pp_yearly_plan_helper' => '',
            'stripe_monthly_plan' => 'ID do Plano Mensal Stripe',
            'stripe_monthly_plan_helper' => '',
            'stripe_yearly_plan' => 'ID do Plano Anual Stripe',
            'stripe_yearly_plan_helper' => '',
            'price_monthly_helper' => '',
            'price_yearly' => 'Preço (anual)',
            'price_yearly_helper' => '',
            'type' => 'Tipo',
            'type_helper' => '',
            'word_limit' => 'Limite de palavras',
            'word_limit_helper' => '',
            'image_limit' => 'Limite de imagem',
            'image_limit_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
            'seats_limit' => 'Limite de assentos',
            'seats_limit_helper' => '',
            'features' => 'Características',
            'features_helper' => '',
        ),
    ),
    'subscription' => array(
        'title' => 'Assinaturas',
        'title_singular' => 'Inscrição',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'user' => 'Do utilizador',
            'user_helper' => '',
            'plan' => 'Plano',
            'plan_helper' => '',
            'start_at' => 'Começa ás',
            'start_at_helper' => '',
            'end_at' => 'Termina em',
            'end_at_helper' => '',
            'canceled_at' => 'Cancelado em',
            'canceled_at_helper' => '',
            'status' => 'Status',
            'status_helper' => '',
            'payment_frequency' => 'Frequência de Pagamento',
            'payment_frequency_helper' => '',
            'pp_subscription' => 'ID de assinatura do PayPal',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'payment' => array(
        'title' => 'Pagamentos',
        'title_singular' => 'Pagamento',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'user' => 'Do utilizador',
            'user_helper' => '',
            'currency' => 'Moeda',
            'currency_helper' => '',
            'payment_method' => 'Forma de pagamento',
            'payment_method_helper' => '',
            'subscription' => 'Inscrição',
            'subscription_helper' => '',
            'amount' => 'Quantia',
            'amount_helper' => '',
            'status' => 'Status',
            'status_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'paymentManagement' => array(
        'title' => 'Gestão de Pagamentos',
        'title_singular' => 'Gestão de Pagamentos',
    ),
    'subscriptionManagement' => array(
        'title' => 'Gerenciamento de assinaturas',
        'title_singular' => 'Gerenciamento de assinaturas',
    ),
    'setting' => array(
        'title' => 'Configurações',
        'title_singular' => 'Configurações',
        'payment_settings' => 'Configurações de pagamento',
        'currency_settings' => 'Configurações de moeda',
        'content_settings' => 'Configurações de conteúdo',
        'content' => 'Contente',
        'subscriptions_settings' => 'Configurações de assinaturas',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'currency' => 'Moeda Ativa',
            'currency_helper' => '',
            'yearly_plan' => 'Plano Anual',
            'yearly_plan_helper' => 'Habilita/Desabilita os clientes a comprar o plano anual',
            'language' => 'Idioma padrão',
            'language_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
            'locale' => 'Local padrão',
            'locale_helper' => '',
            'theme' => 'Tema Padrão',
            'theme_helper' => '',
        ),
        'locale_settings' => 'Configurações de localidade',
        'theme_settings' => 'Configurações de tema',
        'google_call_back_url' => 'URL de retorno de chamada do Google',
        'google_setting' => 'Configurações do Google',
        'google_client_id' => 'ID do cliente do Google',
        'google_client_secret' => 'Segredo do cliente do Google',
        'login_by_google' => 'Ativar login com o Google',
        'default_currency' => 'Moeda Padrão',
        'enable_pp_payment' => 'Habilitar pagamento com PayPal',
        'enable_stripe_payment' => 'Habilitar pagamento com Stripe',
        'custom_scripts' => 'Scripts personalizados',
        'head_script' => 'roteiros principais',
        'body_script' => 'Scripts de corpo',
        'head_script_helper' => '',
        'body_script_helper' => '',
        'default_colors' => 'Cores padrão',
        'primary_color' => 'primário',
        'secondary_color' => 'Secundário',
        'success_color' => 'Sucesso',
        'info_color' => 'Informações',
        'warning_color' => 'Aviso',
        'danger_color' => 'Perigo',
        'dark_color' => 'Escuro',
        'primary_color_helper' => '',
        'secondary_color_helper' => '',
        'success_color_helper' => '',
        'info_color_helper' => '',
        'warning_color_helper' => '',
        'danger_color_helper' => '',
        'dark_color_helper' => '',
    ),
    'brand' => array(
        'title' => 'Marca',
        'title_singular' => 'Marca',
        'social_media_links' => 'links de mídia social',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'site_title' => 'titulo do site',
            'site_title_helper' => '',
            'slogan' => 'Slogan',
            'slogan_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
            'logo' => 'Logotipo',
            'logo_helper' => 'Tamanho recomendado 240 x 72 pixels',
            'email' => 'E-mail',
            'email_helper' => '',
            'address' => 'Endereço',
            'address_helper' => '',
            'phone' => 'Telefone',
            'phone_helper' => '',
            'version' => 'Versão',
            'version_helper' => '',
            'favicon' => 'Favicon',
            'favicon_helper' => '',
            'facebook' => 'Facebook',
            'facebook_helper' => '',
            'instagram' => 'Instagram',
            'instagram_helper' => '',
            'twitter' => 'Twitter',
            'twitter_helper' => '',
            'youtube' => 'YouTube',
            'youtube_helper' => '',
            'google' => 'Google',
            'google_helper' => '',
        ),
    ),
    'thirdParty' => array(
        'title' => 'Terceiro',
        'title_singular' => 'Terceiro',
        'openai_settings' => 'Configurações do OpenAI',
        'paypal_settings' => 'Configurações do PayPal',
        'stripe_settings' => 'Configurações de listras',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'default_max_tokens' => 'Tokens máximos padrão',
            'default_max_tokens_helper' => 'Use esta calculadora https://platform.openai.com/tokenizer para obter uma estimativa precisa',
            'engine' => 'Motor Padrão',
            'engine_helper' => '',
            'openai_api_key' => 'Chave da API OpenAI',
            'openai_api_key_helper' => '',
            'pp_client' => 'ID do cliente do PayPal',
            'pp_client_helper' => '',
            'pp_secret' => 'Segredo do PayPal',
            'pp_secret_helper' => '',
            'pp_env' => 'Ambiente do PayPal',
            'pp_env_helper' => '',
            'stripe_key' => 'Chave Stripe',
            'stripe_key_helper' => '',
            'stripe_secret' => 'Stripe Segredo',
            'stripe_secret_helper' => '',
            'stripe_webhook_secret' => 'Segredo do Webhook Stripe',
            'stripe_webhook_secret_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
            'pp_webhook_secret_helper' => '',
            'pp_webhook_secret' => 'Segredo do webhook do PayPal',
        ),
    ),
    'customize' => array(
        'title' => 'Customizar',
        'title_singular' => 'Customizar',
    ),
    'hero' => array(
        'title' => 'Herói',
        'title_singular' => 'Herói',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'subtitle' => 'Legenda',
            'subtitle_helper' => '',
            'image' => 'Imagem',
            'image_helper' => 'Tamanho recomendado 1098 x 740 pixels',
            'cta' => 'Chamada para ação',
            'cta_helper' => '',
            'promotion' => 'Promoção',
            'promotion_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'partner' => array(
        'title' => 'Parceiros',
        'title_singular' => 'Parceiro',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'url' => 'url',
            'url_helper' => '',
            'logo' => 'Logotipo',
            'logo_helper' => 'Tamanho recomendado 140 x 47 pixels',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'landingPage' => array(
        'title' => 'página de destino',
        'title_singular' => 'página de destino',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
            'hero' => 'Herói',
            'hero_helper' => '',
            'partners' => 'Parceiros',
            'partners_helper' => '',
            'story' => 'História',
            'story_helper' => '',
            'pricing' => 'Preços',
            'pricing_helper' => '',
            'testimonial' => 'Depoimento',
            'testimonial_helper' => '',
        ),
    ),
    'story' => array(
        'title' => 'História',
        'title_singular' => 'História',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'subtitle' => 'Legenda',
            'subtitle_helper' => '',
            'promotion' => 'Promoção',
            'promotion_helper' => '',
            'browser_image' => 'Imagem do navegador',
            'browser_image_helper' => 'Tamanho recomendado 1618 x 1010 pixels',
            'phone_image' => 'Imagem do telefone',
            'phone_image_helper' => 'Tamanho recomendado 407 x 867 pixels',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
            'block' => 'Blocos',
            'block_helper' => '',
        ),
    ),
    'pricing' => array(
        'title' => 'Preços',
        'title_singular' => 'Preços',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'subtitle' => 'Legenda',
            'subtitle_helper' => '',
            'promotion' => 'Promoção',
            'promotion_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'testimonial' => array(
        'title' => 'Testemunhos',
        'title_singular' => 'Depoimento',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'name' => 'Nome',
            'name_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'avatar' => 'avatar',
            'avatar_helper' => 'Tamanho recomendado 514 x 440 pixels',
            'review' => 'Análise',
            'review_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'block' => array(
        'title' => 'Blocos',
        'title_singular' => 'Bloquear',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'icon' => 'Ícone',
            'icon_helper' => 'Tamanho recomendado 68 x 68 pixels',
            'title' => 'Título',
            'title_helper' => '',
            'subtitle' => 'Legenda',
            'subtitle_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'engine' => array(
        'title' => 'Motores',
        'title_singular' => 'Motor',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'type' => 'Tipo',
            'type_helper' => 'Use o tipo de conclusão de bate-papo para GPT3.5 e GPT4',
            'title' => 'Título',
            'title_helper' => '',
            'value' => 'Valor',
            'value_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'language' => array(
        'title' => 'línguas',
        'title_singular' => 'Linguagem',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'language' => 'Linguagem',
            'language_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'footer' => array(
        'title' => 'Rodapé',
        'title_singular' => 'Rodapé',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'copyrights' => 'direitos autorais',
            'copyrights_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
            'disclaimer' => 'Isenção de responsabilidade',
            'disclaimer_helper' => '',
        ),
    ),
    'dashboardSetting' => array(
        'title' => 'Painel',
        'title_singular' => 'Painel',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'subtitle' => 'Legenda',
            'subtitle_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
            'image' => 'Imagem',
            'image_helper' => 'Tamanho recomendado 1351 × 1076 pixels',
        ),
    ),
    'contentManagement' => array(
        'title' => 'Gerenciamento de conteúdo',
        'title_singular' => 'Gerenciamento de conteúdo',
    ),
    'contentCategory' => array(
        'title' => 'Categorias',
        'title_singular' => 'Categoria',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'name' => 'Nome',
            'name_helper' => '',
            'slug' => 'lesma',
            'slug_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'contentTag' => array(
        'title' => 'Tag',
        'title_singular' => 'Marcação',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'name' => 'Nome',
            'name_helper' => '',
            'slug' => 'lesma',
            'slug_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'contentPage' => array(
        'title' => 'Páginas',
        'title_singular' => 'Página',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'category' => 'Categorias',
            'category_helper' => '',
            'tag' => 'Tag',
            'tag_helper' => '',
            'page_text' => 'Texto completo',
            'page_text_helper' => '',
            'excerpt' => 'Excerto',
            'excerpt_helper' => '',
            'featured_image' => 'Imagem em destaque',
            'featured_image_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'locale' => array(
        'title' => 'localidades',
        'title_singular' => 'Localidade',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'slug' => 'lesma',
            'slug_helper' => '',
            'flag_name' => 'Nome da bandeira',
            'flag_name_helper' => '',
            'status' => 'Status',
            'status_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'page' => array(
        'title' => 'Páginas',
        'title_singular' => 'Página',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'theme' => 'Tema',
            'theme_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'theme' => array(
        'title' => 'Temas',
        'title_singular' => 'Tema',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'section' => array(
        'title' => 'Seções',
        'title_singular' => 'Seção',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'title' => 'Título',
            'title_helper' => '',
            'description' => 'Descrição',
            'description_helper' => '',
            'image' => 'Imagem',
            'image_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'component' => array(
        'title' => 'Componentes',
        'title_singular' => 'Componente',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'type' => 'Tipo',
            'type_helper' => '',
            'content' => 'Contente',
            'content_helper' => '',
            'image' => 'Imagem',
            'image_helper' => '',
            'created_at' => 'Criado em',
            'created_at_helper' => '',
            'updated_at' => 'Atualizado em',
            'updated_at_helper' => '',
            'deleted_at' => 'Excluído em',
            'deleted_at_helper' => '',
        ),
    ),
    'general' => array(
        'title' => 'Em geral',
        'title_singular' => 'Configurações Gerais',
        'fields' => array(
            'key' => 'Chave',
            'value' => 'Valor',
            'key_helper' => '',
            'value_helper' => '',
        ),
    ),
    'invoice' => array(
        'title' => 'Faturas',
        'title_singular' => 'Fatura',
        'receipt_number' => 'Número do Recibo',
        'date_paid' => 'Data de pagamento',
        'creativeAI' => 'Creative AI',
        'bill_to' => 'projeto de lei para',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'user_id' => 'Do utilizador',
            'payment_method_id' => 'Forma de pagamento',
            'date' => 'Data',
            'number' => 'Número da fatura',
            'discount' => 'Desconto',
            'amount' => 'Quantia',
            'notes' => 'Notas',
            'url_key' => 'Chave de fatura',
        ),
    ),
    'invoice_item' => array(
        'title' => 'Unid',
        'title_singular' => 'Unid',
        'fields' => array(
            'id' => 'EU IA',
            'id_helper' => '',
            'invoice_id' => 'Fatura',
            'plan_id' => 'Plano',
            'price' => 'Preço unitário',
            'quantity' => 'quantidade',
            'description' => 'Descrição',
        ),
    ),
);
