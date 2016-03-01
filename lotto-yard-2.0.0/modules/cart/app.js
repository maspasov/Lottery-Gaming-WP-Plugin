// angular code
var icelotto = angular.module('myApp', ['ngCart', 'angular-cache', 'ngResource', 'ngDialog', 'fancyboxplus', 'countdownApp', 'animateNumbersModule']);

//config cart
icelotto.value('RESTApiUrl', CONFIG.adminURL);
icelotto.value('cartTranslationUrl', CART_CONFIG.CART_TRANSLATION_URL);

//paymentsystem List
icelotto.constant("PaymentSystems", [
                            { "name": "creditcard", "logo": "creditcards.png", "processor": "CreditCard", "needmoreinfo": 1 }]);
                            // { "name": "skrill", "logo": "skrilllogo.png", "processor": "Skrill", "needmoreinfo": 0 },
                            // { "name": "yandex", "logo": "yandexlogo.png", "processor": "AccentPayYandex", "needmoreinfo": 0 },
                            // { "name": "moneta", "logo": "monetalogo.png", "processor": "AccentPayMonetaRu", "needmoreinfo": 0 },
                            // { "name": "c24", "logo": "c24logo.png", "processor": "AccentPayContact24", "needmoreinfo": 1 },
                            // { "name": "compay", "logo": "compaylogo.png", "processor": "AccentPayComepay", "needmoreinfo": 1 }]

//4,14,19,2,3
icelotto.constant("Products", [
							{ "id": "1", "Name": "Personal" },
							{ "id": "2", "Name": "PersonalAndGroup" },
                            { "id": "3", "Name": "Group" },
                            { "id": "14", "Name": "TopLottoGroup" }
                ]);

icelotto.constant("ErrorMessages",
    {
        "en": [
            { "error": "'Email' is not a valid email address.", "text": "Email is not a valid email address."},
            { "error": "Email already exists.", "text": "You already have an account with us, please login" },
            { "error": "Please insert valid password", "text": "Password length must be between 7 to 10 characters" },
            { "error": "Please insert valid full name", "text": "Name must not include numbers and be 2-20 characters." },
            { "error": "'Email' should not be empty.", "text": "Invalid Email format" },
            { "error": "Property Mobile Number is not a valid phone number!", "text": "Phone should contain numbers only!!" }
        ],
        "de": [
            { "error": "Email already exists.", "text": "Sie haben bereits ein Konto bei uns, bitte anmelden" },
            { "error": "Please insert valid password", "text": "Bitte geben gültigen passwort" },
            { "error": "Please insert valid full name", "text": "Bitte geben gültigen Vornamen" },
            { "error": "'Email' should not be empty.", "text": "Ungültige E-Mail foramt" },
            { "error": "Property Mobile Number is not a valid phone number!", "text": "- Zahlen bestehen" }
        ],
        "fr": [
           { "error": "Email already exists.", "text": "Vous avez déjà un compte avec nous, s'il vous plaît connecter" },
           { "error": "Please insert valid password", "text": "Password length must be between 7 to 10 characters" },
           { "error": "Please insert valid full name", "text": "Name must not include numbers and be 2-20 characters." },
           { "error": "'Email' should not be empty.", "text": "Invalid Email format" },
           { "error": "Property Mobile Number is not a valid phone number!", "text": "Phone should contain numbers only!!" }
        ],
        "ru": [
           { "error": "Email already exists.", "text": "У вас уже есть аккаунт в нашей системе, пожалуйста, войдите" },
           { "error": "Please insert valid password", "text": "Password length must be between 7 to 10 characters" },
           { "error": "Please insert valid full name", "text": "Name must not include numbers and be 2-20 characters." },
           { "error": "'Email' should not be empty.", "text": "Invalid Email format" },
           { "error": "Property Mobile Number is not a valid phone number!", "text": "Phone should contain numbers only!!" }
        ],
        "es": [
           { "error": "Email already exists.", "text": "You already have an account with us, please login" },
           { "error": "Please insert valid password", "text": "Password length must be between 7 to 10 characters" },
           { "error": "Please insert valid full name", "text": "Name must not include numbers and be 2-20 characters." },
           { "error": "'Email' should not be empty.", "text": "Invalid Email format" },
           { "error": "Property Mobile Number is not a valid phone number!", "text": "Phone should contain numbers only!!" }
        ],
        "nl": [
           { "error": "Email already exists.", "text": "You already have an account with us, please login" },
           { "error": "Please insert valid password", "text": "Password length must be between 7 to 10 characters" },
           { "error": "Please insert valid full name", "text": "Name must not include numbers and be 2-20 characters." },
           { "error": "'Email' should not be empty.", "text": "Invalid Email format" },
           { "error": "Property Mobile Number is not a valid phone number!", "text": "Phone should contain numbers only!!" }
        ]
    }
);