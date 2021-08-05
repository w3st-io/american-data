<?php
define('PRODUCTION', false)
define('TITLE', 'americandata');
define('DB_HOST', 'localhost');
define('VINDECODER_API_KEY', 'c404ea350amsh3a1bf345dd7386fp1bcde5jsnad8d954aa8d4');
define('SECRET_JWT_KEY', 'a54b94bc3b94d6a330a859f37b9231e571a0f7966d2c44557e219ad7440c80ef4d2');


if (PRODUCTION == true) {
	define('DATABASE_NAME', 'vin_vehicles');
	define('DATABASE_USER', 'vin_vehicles');
	define('DATABASE_PASSWORD', 'E$&FR-6AJ)xw');
	define('STRIPE_KEY', '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');
}
else {
	define('DATABASE_NAME', 'americandata');
	define('DATABASE_USER', 'root');
	define('DATABASE_PASSWORD', '');
	define('STRIPE_KEY', 'sk_test_51INvnfCC0rHo3XXZxdgGXsFDstmtEnCGYux6ZA8XlySkrSsYqHAa5kOFptGb8k2w6TtyOAuJhiBpeeTkXShldA6E00XuTKIQ3h');
}