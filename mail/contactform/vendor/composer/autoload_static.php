<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9995d1e62babaea04a4742f6f17b4a74
{
    public static $prefixLengthsPsr4 = array(
        'R' =>
            array(
                'ReCaptcha\\' => 10,
            ),
        'P' =>
            array(
                'PHPMailer\\PHPMailer\\' => 20,
            ),
    );

    public static $prefixDirsPsr4 = array(
        'ReCaptcha\\' =>
            array(
                0 => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha',
            ),
        'PHPMailer\\PHPMailer\\' =>
            array(
                0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
            ),
    );

    public static $classMap = array(
        'PHPMailer\\PHPMailer\\Exception' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/Exception.php',
        'PHPMailer\\PHPMailer\\OAuth' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/OAuth.php',
        'PHPMailer\\PHPMailer\\PHPMailer' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/PHPMailer.php',
        'PHPMailer\\PHPMailer\\POP3' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/POP3.php',
        'PHPMailer\\PHPMailer\\SMTP' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/SMTP.php',
        'ReCaptcha\\ReCaptcha' => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha/ReCaptcha.php',
        'ReCaptcha\\RequestMethod' => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha/RequestMethod.php',
        'ReCaptcha\\RequestMethod\\Curl' => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha/RequestMethod/Curl.php',
        'ReCaptcha\\RequestMethod\\CurlPost' => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha/RequestMethod/CurlPost.php',
        'ReCaptcha\\RequestMethod\\Post' => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha/RequestMethod/Post.php',
        'ReCaptcha\\RequestMethod\\Socket' => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha/RequestMethod/Socket.php',
        'ReCaptcha\\RequestMethod\\SocketPost' => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha/RequestMethod/SocketPost.php',
        'ReCaptcha\\RequestParameters' => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha/RequestParameters.php',
        'ReCaptcha\\Response' => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha/Response.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9995d1e62babaea04a4742f6f17b4a74::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9995d1e62babaea04a4742f6f17b4a74::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9995d1e62babaea04a4742f6f17b4a74::$classMap;

        }, null, ClassLoader::class);
    }
}
