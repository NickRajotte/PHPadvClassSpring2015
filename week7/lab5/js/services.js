'use strict';

var appServices = angular.module('appServices', []);

appServices.factory('emailTypesProvider', ['$http', 'config', function($http, config) {

    var url = config.endpoints.emailtypes;
    var model = config.models.emailtype;

    return {
        "getEmailTypes": function () {
            return $http.get(url);
        },
        "postEmailType": function (emailtype, active) {
            model.emailtype = emailtype;
            model.active = active;
            return $http.post(url, model);
        },
        "deleteEmailType" : function (emailtypeid) {
            var _url = url + emailtypeid;
            return $http.delete(_url);
        },
        "updateEmailType" : function (emailtypeid, emailtype, active) {
            var _url = url + emailtypeid;
            model.emailtype = emailtype;
            model.active = active;
            return $http.put(_url, model);
        }
    };
}]);


appServices.factory('emailsProvider', ['$http', 'config', function($http, config) {

    var url = config.endpoints.emails;
    var model = config.models.email;

    return {
        "getEmails": function () {
            return $http.get(url);
        },
        "postEmail": function (email, emailtypeid, active) {
            model.email = email;
            model.emailtypeid = emailtypeid;
            model.active = active;
            return $http.post(url, model);
        },
        "deleteEmail" : function (emailid) {
            var _url = url + emailid;
            return $http.delete(_url);
        },
         "updateEmail" : function (emailid, emailtype, emailtypeid, active) {
            var _url = url + emailid;
            model.email = emailtype;
            model.emailtypeid = emailtypeid;
            model.active = active;
            return $http.put(_url, model);
        }
    };
}]);


