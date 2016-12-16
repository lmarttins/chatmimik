<?php

use Mockery as m;
use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Test messages controller
 */
class MessageTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Messages eloquent model mock
     *
     * @var Chatmimik\Message
     */
    protected $messages;

    /**
     * Http request mock
     *
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * Set up mocks for dependencies
     */
    public function setUp()
    {
        parent::setUp();

        $this->messages = m::mock(Chatmimik\Message::class);
        $this->request  = m::mock(Illuminate\Http\Request::class);

        $this->app->instance(Chatmimik\Message::class, $this->messages);
        $this->app->instance(Illuminate\Http\Request::class, $this->request);
    }

    /**
     * Test initial messages are displayed in the correct format
     *
     * @return void
     */
    public function testReturnsInitialMessagesInCorrectFormat()
    {
        $messages = factory(Chatmimik\Message::class, 20)->make();

        $this->messages->shouldReceive('orderBy')
            ->once()
            ->with('id', 'desc')
            ->andReturn($this->messages);

        $this->messages->shouldReceive('take')
            ->once()
            ->with(20)
            ->andReturn($this->messages);

        $this->messages->shouldReceive('get')
            ->once()
            ->andReturn($this->messages);

        $this->messages->shouldReceive('reverse')
            ->once()
            ->andReturn($this->messages);

        $this->messages->shouldReceive('toJson')
            ->once()
            ->andReturn($messages);

        $response = $this->call('GET', 'messages');

        $this->assertJsonStringEqualsJsonString(
            $response->getContent(),
            $messages->toJson()
        );

        $this->assertResponseOk();
    }

    /**
     * Test new messsages can be created by users
     *
     * @return void
     */
    public function testNewMessagesCanBeSaved()
    {
        $input = [
            'username' => 'foo',
            'message'  => 'bar'
        ];
        $message = factory(Chatmimik\Message::class)->make($input);

        $this->request
            ->shouldReceive('input')
            ->andReturn($input);

        $this->messages
            ->shouldReceive('create')
            ->with($input)
            ->andReturn($message);

        $this->expectsEvents(Chatmimik\Events\MessagePublished::class);

        $response = $this->call('POST', 'messages');

        $this->assertJsonStringEqualsJsonString(
            $response->getContent(),
            $message->toJson()
        );

        $this->assertEquals(201, $response->status());
    }
}
