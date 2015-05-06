

           {!!Form::open(['route'=>['admin.emps.destroy',$emp], 'method'=> 'DELETE'])!!}

            <div class="form-group">
              <div class="col-md-0 col-md-offset-4">
                <button type="submit" onclick="return confirm ('Esta seguro de eliminar el registro?')"class="btn btn-danger">
                 Eliminar Usuario
                </button>
              </div>
            </div>

          {!!Form::close()!!}

