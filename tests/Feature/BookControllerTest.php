<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Book;
use App\Author;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function unauthenticated_users_cannot_view_books_list()
    {
        auth()->logout();
        $this->get("/reading-list")
            ->assertRedirect('login');
    }

    /** @test */
    function unauthenticated_users_cannot_view_individual_books()
    {
        auth()->logout();
        $this->get("/google-books/j23b4iub234")
            ->assertRedirect('login');
    }

    /** @test  */
    function authenticated_users_can_add_books_to_their_reading_list($user = null)
    {
        $user = $user ?: factory(User::class)->create();
        $this->actingAs($user);

        $request_body = [
            'title' => 'New Locker Bankz',
            'author' => 'Authors Name',
            'image' => 'img.com/image-file.jpg',
            'google_id' => 'k32j4lk2j34',
            'description' => 'this book volume info description',
            'page_count' => 94
        ];

        $this->post("/books", $request_body)->assertStatus(201);

        $this->assertDatabaseHas('books', [
            'title' => 'New Locker Bankz',
            'google_id' => 'k32j4lk2j34',
            'image' => 'img.com/image-file.jpg',
        ]);
    }

    /** @test  */
    function it_creates_an_author_if_one_does_not_exist($user = null)
    {
        $user = $user ?: factory(User::class)->create();
        $this->actingAs($user);

        $authors = Author::get();
        $this->assertCount( 0, $authors);

        $request_body = [
            'title' => 'New Locker Bankz',
            'author' => 'Authors Name',
            'image' => 'img.com/image-file.jpg',
            'google_id' => 'k32j4lk2j34',
            'description' => 'this book volume info description',
            'page_count' => 94
        ];

        $this->post("/books", $request_body)
            ->assertStatus(201);

        $authors = Author::get();
        $this->assertCount( 1, $authors);
        $this->assertDatabaseHas('authors', [
            'first_name' => 'Authors',
            'last_name' => 'Name',
        ]);
    }

    /** @test  */
    function it_does_not_create_an_author_if_they_already_exist($user = null)
    {
        $user = $user ?: factory(User::class)->create();
        $this->actingAs($user);

        $author = factory(Author::class)->create();
        $authors = Author::get();
        $this->assertCount( 1, $authors);

        $request_body = [
            'title' => 'New Locker Bankz',
            'author' => $author->first_name . ' ' . $author->last_name,
            'image' => 'img.com/image-file.jpg',
            'google_id' => 'k32j4lk2j34',
            'description' => 'this book volume info description',
            'page_count' => 94
        ];

        echo $author->first_name . ' ' . $author->last_name;
        $this->post("/books", $request_body)
            ->assertStatus(201);

        $authors = Author::get();
        $this->assertCount( 1, $authors);
        $this->assertDatabaseHas('authors', [
            'first_name' => $author->first_name,
            'last_name' => $author->last_name,
        ]);
    }

    /** @test  */
    function it_requires_a_google_id_to_add_book_to_reading_list($user = null)
    {
        $user = $user ?: factory(User::class)->create();
        $this->actingAs($user);

        $request_body = [
            'author' => 'Authors Name',
            'title' => 'Some new title',
            'image' => 'img.com/image-file.jpg',
        ];

        $this->post("/books", $request_body);

        $this->assertDatabaseMissing('books', [
            'image' => 'img.com/image-file.jpg',
        ]);
    }

    /** @test  */
    function it_requires_a_title_to_add_book_to_reading_list($user = null)
    {
        $user = $user ?: factory(User::class)->create();
        $this->actingAs($user);

        $request_body = [
            'author' => 'Authors Name',
            'google_id' => 'k32j4lk2j34',
            'image' => 'img.com/image-file.jpg',
        ];

        $this->post("/books", $request_body);

        $this->assertDatabaseMissing('books', [
            'google_id' => 'k32j4lk2j34',
            'image' => 'img.com/image-file.jpg',
        ]);
    }
}
