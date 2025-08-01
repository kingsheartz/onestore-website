<?php
/**
 * BSD 3-Clause License
 * @copyright (c) 2019, Google Inc.
 * @link https://www.google.com/recaptcha
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright notice, this
 *    list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * 3. Neither the name of the copyright holder nor the names of its
 *    contributors may be used to endorse or promote products derived from
 *    this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

require __DIR__ . '/appengine-https.php';

// Initiate the autoloader. The file should be generated by Composer.
// You will provide your own autoloader or require the files directly if you did
// not install via Composer.
require_once __DIR__ . '/../vendor/autoload.php';

// This example shows the use of a Content Security Policy
// https://developers.google.com/web/fundamentals/security/csp/

// First we generate a pseudorandom nonce for each included or inline script
$nonce = base64_encode(openssl_random_pseudo_bytes(16));

// Send the CSP header
// Try commenting out the various lines to see what effect it has

// NOTE: Always test your policy Content-Security-Policy-Report-Only first to
// ensure you're not blocking any critical functionality. CSP is an important
// security feature but you can break entire sections of your site if you
// implement it incorrectly.
header(
    "Content-Security-Policy: "
    . "default-src 'none'; " // By default we will deny everything

    . "script-src 'nonce-" . $nonce . "' 'strict-dynamic'; " // nonce allowing the reCAPTCHA library and other third-party scripts to be included

    . "img-src https://www.gstatic.com/recaptcha/ https://www.google-analytics.com; " // allow images from these URLS
    . "frame-src https://www.google.com/; " // allow frames from this URL

    . "style-src 'self'; " // allow style from our own origin
    . "connect-src 'self'; " // allow the fetch calls to our own origin
);

// Register API keys at https://www.google.com/recaptcha/admin
$siteKey = '';
$secret = '';

// Copy the config.php.dist file to config.php and update it with your keys to run the examples
if ($siteKey == '' && is_readable(__DIR__ . '/config.php')) {
    $config = include __DIR__ . '/config.php';
    $siteKey = $config['v3']['site'];
    $secret = $config['v3']['secret'];
}

// reCAPTCHA supports 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = 'en';

// The v3 API lets you provide some context for the check by specifying an action.
// See: https://developers.google.com/recaptcha/docs/v3
$pageAction = 'examples/csp';

?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,height=device-height,minimum-scale=1">
<link rel="shortcut icon" href="https://www.gstatic.com/recaptcha/admin/favicon.ico" type="image/x-icon" />
<link rel="canonical" href="https://recaptcha-demo.appspot.com/recaptcha-content-security-policy.php">
<script
    type="application/ld+json">{ "@context": "http://schema.org", "@type": "WebSite", "name": "reCAPTCHA demo - Content Security Policy", "url": "https://recaptcha-demo.appspot.com/recaptcha-content-security-policy.php" }</script>
<meta name="description" content="reCAPTCHA demo - Content Security Policy" />
<meta property="og:url" content="https://recaptcha-demo.appspot.com/recaptcha-content-security-policy.php" />
<meta property="og:type" content="website" />
<meta property="og:title" content="reCAPTCHA demo - Content Security Policy" />
<meta property="og:description" content="reCAPTCHA demo - Content Security Policy" />
<link rel="stylesheet" type="text/css" href="/examples.css">
<title>reCAPTCHA demo - Content Security Policy</title>
<header>
    <h1>reCAPTCHA demo</h1>
    <h2>Content Security Policy</h2>
    <p><a href="/">↩️ Home</a></p>
</header>
<main>
    <?php
    if ($siteKey === '' || $secret === ''):
        ?>
        <h2>Add your keys</h2>
        <p>If you do not have keys already then visit <kbd> <a
                    href="https://www.google.com/recaptcha/admin">https://www.google.com/recaptcha/admin</a></kbd> to
            generate them. Edit this file and set the respective keys in <kbd>$siteKey</kbd> and <kbd>$secret</kbd>. Reload
            the page after this.</p>
        <?php
    else:
        ?>
        <p>This example is sending the <kbd>Content-Security-Policy</kbd> header. Look at the source and inspect the network
            tab for this request to see what's happening. The reCAPTCHA v3 API is being called here, however you can use the
            same approach for the v2 API calls as well.</p>
        <p><strong>NOTE:</strong>This is a sample implementation, the score returned here is not a reflection on your Google
            account or type of traffic. In production, refer to the distribution of scores shown in <a
                href="https://www.google.com/recaptcha/admin" target="_blank">your admin interface</a> and adjust your own
            threshold accordingly. <strong>Do not raise issues regarding the score you see here.</strong></p>
        <ol id="recaptcha-steps">
            <li class="step0">reCAPTCHA script loading</li>
            <li class="step1 hidden"><kbd>grecaptcha.ready()</kbd> fired, calling
                <pre>grecaptcha.execute('<?php echo $siteKey; ?>', {action: '<?php echo $pageAction; ?>'})'</pre>
            </li>
            <li class="step2 hidden">Received token from reCAPTCHA service, sending to our backend with:
                <pre class="token">fetch('/recaptcha-v3-verify.php?token=abc123</pre>
            </li>
            <li class="step3 hidden">Received response from our backend:
                <pre class="response">{"json": "from-backend"}</pre>
            </li>
        </ol>
        <p><a href="/recaptcha-content-security-policy.php">⤴️ Try again</a></p>

        <!-- Add the nonce for our inline script to this tag -->
        <script nonce="<?php echo $nonce; ?>">
            var onloadCallback = function () {
                const steps = document.getElementById('recaptcha-steps');
                grecaptcha.ready(function () {
                    document.querySelector('.step1').classList.remove('hidden');
                    grecaptcha.execute('<?php echo $siteKey; ?>', { action: '<?php echo $pageAction; ?>' }).then(function (token) {
                        document.querySelector('.token').innerHTML = 'fetch(\'/recaptcha-v3-verify.php?action=<?php echo $pageAction; ?>&token=\'' + token;
                        document.querySelector('.step2').classList.remove('hidden');

                        fetch('/recaptcha-v3-verify.php?action=<?php echo $pageAction; ?>&token=' + token).then(function (response) {
                            response.json().then(function (data) {
                                document.querySelector('.response').innerHTML = JSON.stringify(data, null, 2);
                                document.querySelector('.step3').classList.remove('hidden');
                            });
                        });
                    });
                });
            };
        </script>
        <!-- Add the nonce value for the reCAPTCHA library to its script tag -->
        <script async defer
            src="https://www.google.com/recaptcha/api.js?render=<?php echo $siteKey; ?>&onload=onloadCallback"
            nonce="<?php echo $nonce; ?>"></script>

        <?php
    endif; ?>
</main>

<!-- Google Analytics - adding nonces here for the library and the inline code -->
<script async defer src="https://www.googletagmanager.com/gtag/js?id=UA-123057962-1"
    nonce="<?php echo $nonce; ?>"></script>
<script async
    nonce="<?php echo $nonce; ?>">window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); } gtag('js', new Date()); gtag('config', 'UA-123057962-1');</script>