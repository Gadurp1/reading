<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\UserBook;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test  */
    function a_user_has_subscribed_books()
    {
        $user = factory(User::class)->create();

        $users_books = factory(UserBook::class, 5)->create([
            'user_id' => $user->id
        ]);

        $this->assertEquals( $user->subscribedBooks()->count(), 5);
    }
}
