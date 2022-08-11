<form class="form-horizontal" id="form_akses" method="post">
    <div class="card-body">

      <div class="form-group row mb-5">
        <label for="id_m_user_group_bo" class="col-sm-2 col-form-label">Group Name</label>
        <div class="col-sm-10">
          <input type="hidden"  class="form-control" value="{{$old->id_m_user_group_bo}}" name="id_m_user_group_bo" id="id_m_user_group_bo">
          <input type="text"  class="form-control" readonly="" name="nm_user_group_bo" value="{{$old->nm_user_group_bo}}" id="nm_user_group_bo">
        </div>
      </div>

      <table style="width: auto;" class="table table-hover table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>PAGES</th>
            <th>ACTIVATE / DEACTIVATE</th>
          </tr>
        </thead>

        <tbody>
          @php
          $x = 1;
          @endphp
          @foreach($menu as $m)

          @php
          $cek_by_role = \App\Models\M_hak_akses_bo::where('id_m_user_group_bo', request()->get('id_m_user_group_bo'))->where('id_m_menu_bo', $m->id_m_menu_bo)->first();
          $is_check = ($cek_by_role) ? 'checked' : '';
          @endphp
          <tr>
            <td>{{$x++}}</td>
            <td><strong>{{$m->nm_menu_bo}}</strong></td>
            <td>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" {{$is_check}} value="{{$m->id_m_menu_bo}}" name="cek_{{$m->id_m_menu_bo}}" id="cek_{{$m->id_m_menu_bo}}">
                  </div>
            </td>
          </tr>
              @php
              $getsub = \App\Models\M_menu_bo::where('id_parent', $m->id_m_menu_bo)->get();
              foreach($getsub as $sub){
              @endphp

              @php
              $cek_by_role = \App\Models\M_hak_akses_bo::where('id_m_user_group_bo', request()->get('id_m_user_group_bo'))->where('id_m_menu_bo', $sub->id_m_menu_bo)->first();
              $is_check = ($cek_by_role) ? 'checked' : '';
              @endphp
              <tr>
                <td></td>
                <td> &bull; &nbsp; {{$sub->nm_menu_bo}}</td>
                <td>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" {{$is_check}} value="{{$sub->id_m_menu_bo}}" name="cek_{{$sub->id_m_menu_bo}}" id="cek_{{$sub->id_m_menu_bo}}">
                    </div>
                </td>
              </tr>
              @php
              }
              @endphp
          @endforeach
        </tbody>
      </table>

    </div>
    <!-- /.card-body -->
    <div class="col-sm-9 px-2">
      <button type="submit" id="submitform" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
    </div>
    <!-- /.card-footer -->
  </form>
