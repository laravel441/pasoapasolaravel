    @if ($d==1)

              <table class="table table-hover" data-options="rownumbers:true">
                    <thead>
                      <tr>
                            <th></th>

                      </tr>
                    </thead>
                       <tbody>
                                <td align="center">
                                            <div class="fa-hover ">
                                                <a target="_blank"  href="{{route('facturacion.sticker.edit',$reg_factura->fac_id)}}">
                                                <i class="fa fa-file-pdf-o fa-3x text-danger" title="Generar ultimo sticker"></i></a>
                                                <h4>{{$reg_factura->fac_consecutivo}}</h4>
                                                <h5 class="text-info"><i>Este es el útlimo sticker generado</i></h5>
                                            </div>

                                </td>
                              </tr>

                      </tbody>
                </table>
    @else
    <p></p>
    @endif
