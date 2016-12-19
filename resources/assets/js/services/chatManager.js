angular
    .module('chatmimik')
    .factory('chatManager', chatManager);

chatManager.$inject = ['$http', '$q'];

function chatManager($http, $q) {
    return {
        getMessages() {
            return $q((resolve, reject) => {
                $http.get('messages').success((data) => {
                    resolve(data);
                }).error(() => {
                    reject('Query failed. Try again.');
                });
            });
        }
    }
}
