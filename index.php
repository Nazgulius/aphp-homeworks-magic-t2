<?php
declare(strict_types=1);

trait AppUserAuthentication {
    public string $appLogin = "AppUser";
    public string $appPassword = "AppUserPass";

    public function authenticate(): string {
        if ($this->login === $this->appLogin && $this->password === $this->appPassword) {
            return "Пользователь приложения";
        }
        return "Не найден";
    }
}

trait MobileUserAuthentication {
    public string $mobileLogin = "MobileUser";
    public string $mobilePassword = "MobileUserPass";

    public function authenticate(): string {
        if ($this->login === $this->mobileLogin && $this->password === $this->mobilePassword) {
            return "Пользователь мобильного приложения";
        }
        return "Не найден";
    }
}

class UserAuth {
    public string $login;
    public string $password;

    use AppUserAuthentication, MobileUserAuthentication {
      AppUserAuthentication::authenticate insteadof MobileUserAuthentication; // основной метод
      MobileUserAuthentication::authenticate as authenticateMobile; // переименовываем
    }

    public function __construct(string $login, string $password) {
        $this->login = $login;
        $this->password = $password;
    }

    public function authenticateUser(string $type): string {
        if ($type === 'app') {
            return $this->authenticate();
        } elseif ($type === 'mobile') {
            return $this->authenticateMobile();
        }
        return "Неверный тип авторизации";
    }
}

 // Пользователь приложения
$user = new UserAuth("AppUser", "AppUserPass");
echo $user->authenticateUser('app') . "\n";     
echo $user->authenticateUser('mobile') . "\n";   // Ошибочный

// Пользователь мобильного приложения
$mobileUser = new UserAuth("MobileUser", "MobileUserPass");
echo $mobileUser->authenticateUser('mobile') . "\n"; 