<?php
/**
 * This is a PHP library that handles calling reCAPTCHA.
 *
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

namespace ReCaptcha\RequestMethod;

use \ReCaptcha\ReCaptcha;
use \ReCaptcha\RequestParameters;
use PHPUnit\Framework\TestCase;

class CurlPostTest extends TestCase
{
        protected function setUp()
        {
                if (!extension_loaded('curl')) {
                        $this->markTestSkipped(
                                'The cURL extension is not available.'
                        );
                }
        }

        public function testSubmit()
        {
                $curl = $this->getMockBuilder(\ReCaptcha\RequestMethod\Curl::class)
                        ->disableOriginalConstructor()
                        ->setMethods(array('init', 'setoptArray', 'exec', 'close'))
                        ->getMock();
                $curl->expects($this->once())
                        ->method('init')
                        ->willReturn(new \stdClass);
                $curl->expects($this->once())
                        ->method('setoptArray')
                        ->willReturn(true);
                $curl->expects($this->once())
                        ->method('exec')
                        ->willReturn('RESPONSEBODY');
                $curl->expects($this->once())
                        ->method('close');

                $pc = new CurlPost($curl);
                $response = $pc->submit(new RequestParameters("secret", "response"));
                $this->assertEquals('RESPONSEBODY', $response);
        }

        public function testOverrideSiteVerifyUrl()
        {
                $url = 'OVERRIDE';

                $curl = $this->getMockBuilder(\ReCaptcha\RequestMethod\Curl::class)
                        ->disableOriginalConstructor()
                        ->setMethods(array('init', 'setoptArray', 'exec', 'close'))
                        ->getMock();
                $curl->expects($this->once())
                        ->method('init')
                        ->with($url)
                        ->willReturn(new \stdClass);
                $curl->expects($this->once())
                        ->method('setoptArray')
                        ->willReturn(true);
                $curl->expects($this->once())
                        ->method('exec')
                        ->willReturn('RESPONSEBODY');
                $curl->expects($this->once())
                        ->method('close');

                $pc = new CurlPost($curl, $url);
                $response = $pc->submit(new RequestParameters("secret", "response"));
                $this->assertEquals('RESPONSEBODY', $response);
        }

        public function testConnectionFailureReturnsError()
        {
                $curl = $this->getMockBuilder(\ReCaptcha\RequestMethod\Curl::class)
                        ->disableOriginalConstructor()
                        ->setMethods(array('init', 'setoptArray', 'exec', 'close'))
                        ->getMock();
                $curl->expects($this->once())
                        ->method('init')
                        ->willReturn(new \stdClass);
                $curl->expects($this->once())
                        ->method('setoptArray')
                        ->willReturn(true);
                $curl->expects($this->once())
                        ->method('exec')
                        ->willReturn(false);
                $curl->expects($this->once())
                        ->method('close');

                $pc = new CurlPost($curl);
                $response = $pc->submit(new RequestParameters("secret", "response"));
                $this->assertEquals('{"success": false, "error-codes": ["' . ReCaptcha::E_CONNECTION_FAILED . '"]}', $response);
        }
}
