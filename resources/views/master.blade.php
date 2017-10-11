<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="container">
        <div class="row">
          <br>
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">CURD with Ajax <a href="#" id="addNew" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus pull-right"></i></a></div>
                  <div class="panel-body" id="items">
                    <div class="msg"></div>
                    <ul class="list-group">
                      @foreach ($items as $key => $item)
                        <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">{{ $item->task }}
                          <input type="hidden" id="itemId" value="{{ $item->id }}">
                        </li>
                      @endforeach
                    </ul>
                  </div>
              </div>
          </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modelTitle">List</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id">
            <div class="form-group">
              <input type="text" class="form-control" id="itemName" placeholder="Item name here">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="closeBtn" data-dismiss="modal" style="display:none">Close</button>
            <button type="button" class="btn btn-warning" id="delBtn" style="display:none" data-dismiss="modal">Delete</button>
            <button type="button" class="btn btn-primary" id="saveBtn" style="display:none" data-dismiss="modal">Save changes</button>
            <button type="button" class="btn btn-primary" id="addItems" data-dismiss="modal">Add Item</button>
          </div>
        </div>
      </div>
    </div>
    {{ csrf_field() }}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $(document).on('click', '.ourItem', function(event) {
          $('#saveBtn').show();
          $('#delBtn').show();
          $('#addItems').hide();
          $('#modelTitle').text("Edit item");

          var text = $.trim($(this).text());
          var id = $(this).find('#itemId').val();
          $('#id').val(id);
          $('#itemName').val(text);
        });

        $(document).on('click', '#addNew', function(event) {
          $('#saveBtn').hide();
          $('#delBtn').hide();
          $('#addItems').show();
          $('#itemName').val("");
          $('#modelTitle').text("Add item");
        });

        $('#addItems').click(function(event) {
          var text = $('#itemName').val();
          $.post('{{ route('insert') }}', {'text': text,'_token':$('input[name=_token]').val()}, function(data) {
            $('#items').load(location.href + ' #items');
          });
        });

        $('#delBtn').click(function(event) {
          var id = $('#id').val();
          $.post('{{ route('delete') }}', {'id': id,'_token':$('input[name=_token]').val()}, function(data) {
            $('#items').load(location.href + ' #items');
            console.log(data);
          });
        });

        $('#saveBtn').click(function(event) {
          var id = $('#id').val();
          var value = $.trim($('#itemName').val());
          $.post('{{ route('update') }}', {'id': id,'value':value,'_token':$('input[name=_token]').val()}, function(data) {
            $('#items').load(location.href + ' #items');
            console.log(data);
          });
        });
      });
    </script>
  </body>
</html>
