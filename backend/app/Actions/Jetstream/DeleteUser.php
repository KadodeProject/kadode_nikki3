<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        /** @todo テストで事故るのでコメントアウトしている、もしプロフィール画像導入したら有効にする */
        // $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}