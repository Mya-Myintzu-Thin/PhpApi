<?php

namespace App\Contracts\Services\Auth;


/**
 * Interface for authentication service.
 */
interface AuthServiceInterface
{
  

   /**
   * To login with validated user.
   * @param array $validated Validated fields from request
   * @return array response content and status
   */
   public function login($validated);
}
