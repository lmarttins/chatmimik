angular
    .module('chatmimik')
    .factory('chatManager', chatManager);

chatManager.$inject = ['$http', '$q'];

function chatManager($http, $q) {
    return {
        getMessages() {
            return $q(function(resolve, reject) {
                /*$http.get('messages').success(function(data) {
                    resolve(data);
                }).error(function() {
                    reject('Query failed. Try again.');
                });*/
            });
        }
    }
}
