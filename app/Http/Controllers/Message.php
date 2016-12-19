<?php

namespace Chatmimik\Http\Controllers;

use Chatmimik\Domains\Users\Repositories\UserRepositoryInterface;
use Chatmimik\Http\Requests;
use Illuminate\Http\Request;
use Chatmimik\Events\MessagePublished;
use Chatmimik\Domains\Users\Repositories\UserRepositoryInterface;
use Chatmimik\Domains\Messages\Message as MessageModel;
use Illuminate\Contracts\Events\Dispatcher;

class Message extends Controller
{
    private $messages;

    private $userRepository;

    public function __construct(MessageModel $messages, UserRepositoryInterface $userRepository)
    {
        $this->messages       = $messages;
        $this->userRepository = $userRepository;
    }

    /**
     * Display last 20 messages
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->messages->orderBy('id', 'desc')->take(20)->get()->reverse();
    }

    /**
     * Store a newly created message
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Dispatcher $event)
    {
        $message = $this->messages->create($request->input());

        $event->fire(new MessagePublished($message));

        return response($message, 201);
    }

    public function userByTyping(Request $request, Dispatcher $event)
    {
        $this->userRepository->find($request->get('user_id'));
    }
}
