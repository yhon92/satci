 <script type="text/ng-template" id="myModalContent.html">
 <div class="modal-header">
 <h3 class="modal-title">Im a modal!</h3>
 </div>
 <div class="modal-body">
 <ul>
 <li ng-repeat="item in items">
 <a href="#" ng-click=""</a>
 </li>
 </ul>
 Selected: <b>{{ selected.item }}</b>
 </div>
 <div class="modal-footer">
 <button class="btn btn-warning" type="button" ng-click="close()">Cerrar</button>
 </div>
</script>