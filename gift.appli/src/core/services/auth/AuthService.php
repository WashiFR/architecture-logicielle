<?php

namespace gift\appli\core\services\auth;

use gift\appli\core\domain\User;
use gift\appli\core\services\auth\IAuthService;

class AuthService implements IAuthService
{
    public function signin(string $email, string $password): void
    {
        if (empty($email) || empty($password)) {
            throw new AuthServiceBadDataException('Erreur 400 : Données manquantes', 400);
        }

        try {
            $sql = User::select('id', 'user_id', 'password', 'role')->where('user_id', $email)->first();
        } catch (\Exception $e) {
            throw new AuthServiceNotFoundException('Erreur 404 : Aucun utilisateur trouvé', 404);
        }

        if (password_verify($password, $sql->password)) {
            $_SESSION['user_role'] = $sql->role;
        } else {
            throw new AuthServiceBadDataException('Erreur 400 : Mauvais mot de passe', 400);
        }
    }

    public function signup(string $email, string $password): void
    {
        $sql = User::select('id', 'user_id', 'password')->where('user_id', $email)->first();

        if ($sql) {
            throw new AuthServiceBadDataException('Erreur 400 : Utilisateur déjà existant', 400);
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $user = new User();
        $user->user_id = $email;
        $user->password = $passwordHash;
        $user->role = User::USER;
        $user->save();

        $_SESSION['user_role'] = $user->role;
    }
}