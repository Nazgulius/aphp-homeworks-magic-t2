<?php
declare(strict_types=1);

trait AppUserAuthentication {

  public string $appUserLogin = "AppUser";
  public string $appUserPassword = "AppUserPass";

  public function authenticate(string $login, string $password): string {
    if ($login === $this->appUserLogin && $password === $this->appUserPassword) { 
      return "Пользователь приложения"; 
    }

    return "Не найден";
  }
}

trait MobileUserAuthentication {

  public string $mobileUserLogin = "MobileUser";
  public string $mobileUserPassword = "MobileUserPass";

  public function authenticate(string $login, string $password): string {
    if ($login === $this->mobileUserLogin && $password === $this->mobileUserPassword) { 
      return "Пользователь мобильного приложения"; 
    }

    return "Не найден";
  }
}


class Authentication
{
  use AppUserAuthentication, MobileUserAuthentication {
    AppUserAuthentication::authenticate as authenticateApp;
    MobileUserAuthentication::authenticate as authenticateMobile;
  }

  public function authen (string $login, string $password, string $type = 'app') 
  {
    if ($type === 'app') {
      return $this->authenticateApp($login, $password);
    } elseif ($type === 'mobile') {
      return $this->authenticateMobile($login, $password);
    }
    return "Тип аутентификации не поддерживается";
    
  }
}

$person = new Authentication();
$person->authen("log", "pass", 'app');
$person->authen("MobileUser", "MobileUserPass", 'mobile');