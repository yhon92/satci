import './SharedDirectives';
import './SharedFilters';
import './SharedResources';
import './SharedServices';

angular.module('SATCI.Shared', ['Shared.directives', 'Shared.filters', 'Shared.resources', 'Shared.services'])
.constant('PathTemplates', {
  views:    'templates/views/',
  partials: 'templates/partials/',
})
.constant('ResourcesUrl', {
  api:    '/api/',
  // api:    'http://localhost/satci/public/api/',
  // api:    '/api/',
})
  // var resourceUrl = '/api/';
  // var resourceUrl = 'http://localhost/satci/public/api/';
  // var resourceUrl = 'http://192.168.1.26/satci/public/api/';
  // var resourceUrl = 'http://192.168.0.103/satci/public/api/';
  