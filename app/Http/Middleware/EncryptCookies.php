<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Closure;

class EncryptCookies extends Middleware {

	/**
	 * The names of the cookies that should not be encrypted.
	 *
	 * @var array
	 */
	protected $except = [
		\App\Film::PAGER_SETTINGS['cookie']['param_name'],
			
	];


}
