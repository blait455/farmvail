<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $settings = [
        [
            'key'                       =>  'name',
            'value'                     =>  'Farmvail',
        ],
        [
            'key'                       =>  'description',
            'value'                     =>  'Farmvail Application',
        ],
        [
            'key'                       =>  'address',
            'value'                     =>  '203 Fake St. Mountain View, Dreamland, Enugu, Nigeria',
        ],
        [
            'key'                       =>  'email',
            'value'                     =>  'info@farmvail.com',
        ],
        [
            'key'                       =>  'phone',
            'value'                     =>  '+2 392 3929 210',
        ],
        [
            'key'                       =>  'shipping_fee',
            'value'                     =>  '100',
        ],        [
            'key'                       =>  'site_logo',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'site_favicon',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'footer_copyright_text',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'seo_meta_title',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'seo_meta_description',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_facebook',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_twitter',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_instagram',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_linkedin',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'google_analytics',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'facebook_pixels',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'stripe_payment_method',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'stripe_key',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'stripe_secret_key',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'paypal_payment_method',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'paypal_client_id',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'paypal_secret_id',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'paystack_payment_method',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'paystack_client_id',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'paystack_secret_id',
            'value'                     =>  '',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            Setting::create($setting);
        }
    }
}
