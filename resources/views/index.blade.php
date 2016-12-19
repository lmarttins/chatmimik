<!doctype html>
<html ng-app="chatmimik">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chatmimik | Conversation by mimica, emotions.</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="container" ng-controller="Chat as chat">
        <div class="ui stackable padded grid">
            <aside class="three wide column info-column">
                <h1>Chatmimik</h1>
            </aside>

            <div class="ten wide column chat-column">
                <h2 class="ui header">
                    <i class="comments outline icon"></i>
                    <div class="content">
                        Chat Room
                        <div class="sub header">
                            <small ng-show="chat.memberCount" ng-cloak>
                                Online: @{{ chat.memberCount }}
                            </small>
                        </div>
                    </div>
                </h2>

                <div class="ui comments" scroll-glue ng-cloak>
                    <div class="comment" ng-repeat="message in chat.messages">
                        <div class="avatar">
                            <identicon username="message.username" size="35">
                        </div>
                        <div class="content">
                            <span class="author">@{{ message.username }}</span>
                            <div class="metadata">
                                <div class="date" am-time-ago="message.created_at | amUtc | amLocal"></div>
                            </div>
                            <div class="text">
                                <p>@{{ message.message }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="chat-actions">
                    <form ng-hide="chat.username" ng-submit="chat.setUsername()">
                        <div class="ui fluid action input">
                            <input placeholder="Choose your username..." ng-model="chat.sessionStorage.username" autofocus required>
                            <button class="ui button">Set</button>
                        </div>
                    </form>

                    <form ng-show="chat.username" ng-submit="chat.sendMessage()" ng-cloak>
                        <div class="ui labeled fluid action input">
                            <div class="ui label">
                                @{{ chat.username }} {{trans('label.says')}}:
                            </div>
                            <input placeholder="{{trans('placeholder.write_your_message')}}" ng-model="chat.message" required focus-on="messageReady">
                            <button class="blue ui button">{{trans('btn.send')}}</button>
                        </div>
                    </form>
                </div>
            </div>

            <aside class="three wide column users-column">
                <header class="filter-input">
                    <div class="ui fluid icon input">
                        <input type="text" placeholder="Filter users..." ng-model="filterKeyword">
                        <i class="search icon"></i>
                    </div>
                </header>
                <div class="users-list">
                    <h4>Online Users</h4>
                    <div class="online-users ui tiny middle aligned list" ng-cloak>
                        <div class="item" ng-repeat="user in chat.users | filter: filterKeyword">
                            <identicon username="user.username" size="24" class="ui avatar image"></identicon>
                            <div class="content">
                                <div class="header">@{{ user.username }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <script>
        var chattyConfig = {
            token: "{{ csrf_token() }}",
            PUSHER_KEY: "{{ config('broadcasting.connections.pusher.key') }}"
        };
    </script>
    <script src="/js/all.js"></script>
</body>
</html>
