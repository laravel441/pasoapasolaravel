                    <table class="table table-bordered" >

                        <thead class="danger">
                            <tr class="info">
                             <th><h5>Canal</h5></th>
                             <th><h5>Cantidad</h5></th>
                            </tr>
                        </thead>

                            <tbody>
                                @foreach($channel as $canal)
                                    <tr>
                                        <td><h6>{{$canal->can_nombre}}</h6></td>
                                        <td><h6>{{$canal->cantidad}}</h6></td>
                                    </tr>
                                @endforeach
                            </tbody>

                    </table>

