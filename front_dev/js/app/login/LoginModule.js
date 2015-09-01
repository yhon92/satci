angular.module('SATCI.Login',['ui.router', 'SATCI.Shared'])
.config(($stateProvider, PathTemplates) => {
  $stateProvider
  .state('login', {
    url: '/auth/login',
    templateUrl: `${PathTemplates.views}auth/login.html`,
    controller: 'LoginCtrl'
  })
})
.controller('LoginCtrl', ($auth, $state, $http, $scope, $rootScope, ResourcesUrl, cfpLoadingBar) => {
  cfpLoadingBar.start();
  
  $scope.loginError = false;
  $scope.loginErrorText;

  $scope.login = () => {
    let credentials = {
      username: $scope.username,
      password: $scope.password
    }
    // Use Satellizer's $auth service to login
    $auth.login(credentials).then( () => {
      // If login is successful, redirect to the users state
      // $state.go('home', {});
      // Return an $http request for the now authenticated
      // user so that we can flatten the promise chain
      return $http.get(ResourcesUrl.api + 'auth/user');
    }, (error) => {
      $rootScope.loginError = true;
      $rootScope.loginErrorText = error.data.error;

      // Because we returned the $http.get request in the $auth.login
      // promise, we can chain the next promise to the end here
    }).then( (response) => {
      // Stringify the returned data to prepare it
      // to go into local storage
      let user = JSON.stringify(response.data.user);
      // Set the stringified user data into local storage
      sessionStorage.setItem('user', user);
      // The user's authenticated state gets flipped to
      // true so we can now show parts of the UI that rely
      // on the user being logged in
      $rootScope.authenticated = true;
      // Putting the user's data on $rootScope allows
      // us to access it anywhere across the app
      $rootScope.currentUser = response.data.user;
      // Everything worked out so we can now redirect to
      // the users state to view the data
      $state.go('home');
    });
  }
  setTimeout( () => {
    cfpLoadingBar.complete();
  }, 600);
})