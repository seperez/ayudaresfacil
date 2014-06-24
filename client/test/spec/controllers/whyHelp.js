'use strict';

describe('Controller: WhyhelpCtrl', function () {

  // load the controller's module
  beforeEach(module('ayudarEsFacilApp'));

  var WhyhelpCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    WhyhelpCtrl = $controller('WhyhelpCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
