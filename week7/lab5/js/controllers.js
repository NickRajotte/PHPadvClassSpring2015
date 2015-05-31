'use strict';

var appControllers = angular.module('appControllers', []);

appControllers.controller('EmailTypesCtrl', ['$scope', '$log', 'emailTypesProvider',
    function($scope, $log, emailTypesProvider) {

        $scope.emailTypes = [];

        $scope.emailtype = '';
        $scope.active = '';

        $scope.update = false;

        $scope.updateemailtypeid = '';
        $scope.updateemailtype = '';
        $scope.updateactive = '';

        $scope.addEmailType = function() {

            emailTypesProvider.postEmailType($scope.emailtype, $scope.active).success(function(response) {
                $log.log(response);
                getEmailTypes();
            }).error(function (response, status) {
               $log.log(response);
            });

        };


        $scope.showUpdate = function(index) {

            var emailtype = $scope.emailTypes[index];

            $scope.updateemailtypeid = emailtype.emailtypeid;
            $scope.updateemailtype = emailtype.emailtype;
            $scope.updateactive = emailtype.active;
            $scope.update = true;

        };

        $scope.updateEmailType = function() {

            emailTypesProvider.updateEmailType($scope.updateemailtypeid, $scope.updateemailtype, $scope.updateactive).success(function(response) {
                $log.log(response);
                getEmailTypes();
            }).error(function (response, status) {
               $log.log(response);
            });

            $scope.update = false;
        };


        $scope.deleteEmailType = function(emailtypeid) {

            emailTypesProvider.deleteEmailType(emailtypeid).success(function(response) {
                $log.log(response);
                getEmailTypes();
            }).error(function (response, status) {
               $log.log(response);
            });
        };


        function getEmailTypes() {
            emailTypesProvider.getEmailTypes().success(function(response) {
                $scope.emailTypes = response.data;
            }).error(function (response, status) {
               $log.log(response);
            });
        };

        getEmailTypes();

}])

.controller('EmailsCtrl', ['$scope', '$log', 'emailsProvider', 'emailTypesProvider',
    function($scope, $log, emailsProvider, emailTypesProvider) {

        $scope.emails = [];
        $scope.emailTypes = [];


        $scope.email = '';
        $scope.active = '';
        $scope.emailtype = '';


        $scope.update = false;

        $scope.updateemailid = '';
        $scope.updateemail = '';
        $scope.updateemailtype = '';
        $scope.updateactive = '';


        $scope.addEmail = function() {

            emailsProvider.postEmail($scope.email, $scope.emailtype.emailtypeid, $scope.active).success(function(response) {
                $log.log(response);
                getEmails();
            }).error(function (response, status) {
               $log.log(response);
            });

        };

        $scope.showUpdate = function(index) {

            var email = $scope.emails[index];

            $scope.updateemailid = email.emailid;
            $scope.updateemail = email.email;
            $scope.updateemailtype = getEmailType(email.emailtypeid);
            $scope.updateactive = email.active;
            $scope.update = true;

        };


        function getEmailType(id) {
            var i = $scope.emailTypes.length;

            while ( i-- ) {
                if ( $scope.emailTypes[i].emailtypeid === id ) {
                    break;
                }
            }

           return $scope.emailTypes[i];
        };

        $scope.updateEmail = function() {

            emailsProvider.updateEmail($scope.updateemailid, $scope.updateemail, $scope.updateemailtype.emailtypeid, $scope.updateactive).success(function(response) {
                $log.log(response);
                getEmails();
            }).error(function (response, status) {
               $log.log(response);
            });

            $scope.update = false;
        };

        $scope.deleteEmail = function(emailid) {

            emailsProvider.deleteEmail(emailid).success(function(response) {
                $log.log(response);
                getEmails();
            }).error(function (response, status) {
               $log.log(response);
            });
        };


        function getEmails() {
            emailsProvider.getEmails().success(function(response) {
                 $scope.emails = response.data;
            }).error(function (response, status) {
               $log.log(response);
            });
        };

        getEmails();

        emailTypesProvider.getEmailTypes().success(function(response) {
            $scope.emailTypes = response.data;
            $scope.emailtype = $scope.emailTypes[0];
        }).error(function (response, status) {
           $log.log(response);
        });

}]);




