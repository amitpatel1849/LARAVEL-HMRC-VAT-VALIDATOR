# LARAVEL HMRC VAT VALIDATOR PACKAGE #

This package will check UK VAT Number by using HMRC API.

## What is this repository for?

* Easily integrte UK VAT Validation
* Also check Business Name of the VAT number belongs to.


## How do I Install Package?
You can install the package via composer. Make sure comoser is installed if not then go through https://getcomposer.org/download/

Run the following command: Go to your laravel root directory
```bash
composer require amit-patel/hmrc-vat-validator
```

## How do I Configure Package?

-   Step 1: Publish configuration
    Run following command:
    ```bash
    php artisan vendor:publish --tag=config
    ```
    This command will create a hmrcvatvalidator.php configuration file in your config directory.

-   Step 2: Set below environment variables in your .env file
    ```dotenv
    HMRC_BASE_URL=https://test-api.service.hmrc.gov.uk (change it to production url when you are working with production enverinment)
    HMRC_CLIENT_ID=your-client-id
    HMRC_CLIENT_SECRET=your-client-secret
    ```
-   Step 3: Cleare all cache
    To ensure Laravel recognizes your new configuration, clear the configuration cache:
    ```bash
    php artisan o:c
    ```

## Use guidelines
Once you installation done succesfully. You can check VAT number.

-   Step 1: Setup code in Controller in which you want to verify VAT number.
    ```php
    use AmitPatel\HmrcVatValidator\Facades\HmrcVatValidator;
    public function validateVat()
    {
        $response = HmrcVatValidator::validateVat('123456789');
        return response()->json($response);
    }
    ```
    Step 2: Setup route
    ```php
    Route::get('/validate-vat', [YourController::class, 'validateVat']);
    ```

### Who do I talk to? ###

-   **Name:** Amit Patel
-   **LinkedIn:** https://www.linkedin.com/in/amit-patel-0420a122/

### License ###
This package is open-source software licensed under the MIT License.
