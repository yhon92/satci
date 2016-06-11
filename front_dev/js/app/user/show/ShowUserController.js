angular.module('User.controllers')
.controller('ShowUserCtrl', ($scope, $uibModalInstance, user) => {
  $scope.user = user;  
  $scope.roles = false;
  $scope.notRoles = false;
  $scope.permissions = false;
  $scope.notPermissions = false;

  if (user.roles != undefined && user.roles.length > 0 ) {
    $scope.roles = user.roles;
  } else {
    $scope.notRoles = true;
  }

  if (user.permissions != undefined && user.permissions.length > 0 ) {
    $scope.permissions = user.permissions;
  } else {
    $scope.notPermissions = true;
  }

  $scope.close = () => {
    $uibModalInstance.dismiss();
  };
})