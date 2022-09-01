@extends('admin.layout.index')

@section('content')

              <!-- Advanced Search -->
              <section id="advanced-search-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header border-bottom">
                        <h4 class="card-title">{{$page_title}}</h4>
                      </div>

                      <hr class="my-0" />
                      <div class="card-body">

                        <form method="post" id="form">

                            <div class="row">

                                <input type="hidden" id="id_m_harga" value="{{$old->id_m_harga}}" class="form-control" name="id_m_harga">

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="nominal"> Nominal </label>
                                        </div>
                                        <div class="col-sm-6">

                                            <input type="text" id="nominal" class="form-control inputmask" name="nominal" data-thousands="." data-decimal="," value="{{$old->nominal_m_harga ?? 0}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="nominal"> Cicilan </label>
                                        </div>
                                        <div class="col-sm-6">

                                            <input type="text" id="cicilan" class="form-control inputmask" name="cicilan" data-thousands="." data-decimal="," value="{{$old->nominal_cicilan ?? 0}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="nominal"> Jangka Cicilan</label>
                                        </div>
                                        <div class="col-sm-6">

                                            <input type="number" id="jangka" class="form-control" name="jangka" value="{{$old->jangka_cicilan ?? 0}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="aktif">Status Aktif</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-select" id="aktif" name="aktif">
                                                <option {{($old->status_m_harga == '1') ? 'selected' : ''}} value="1">Ya</option>
                                                <option {{($old->status_m_harga != '1') ? 'selected' : ''}} value="0">Tidak</option>
                                              </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-9 offset-sm-3">
                                <button id="submitform" type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
                                <a href="{{route('admin.m_harga.index')}}" class="btn btn-secondary waves-effect">Back</a>
                                </div>
                            </div>
                        </form>

                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!--/ Advanced Search -->

@endsection

@section('js')
<script src="{{asset('assets/js/jquery.inputmask.min.js')}}"></script>
<script>
    $(document).ready( function () {
        $(".inputmask").inputmask({
            prefix: "",
            groupSeparator: ".",
            radixPoint: ",",
            alias: "currency",
            placeholder: "0",
            autoGroup: true,
            digits: 0,
            digitsOptional: false,
            clearMaskOnLostFocus: false,
            inputmode: "numeric",
            onBeforeMask: function (value, opts) {
                return value;
            },
        });

        $("#form").submit(function(){
            $(".text-danger").remove();
            event.preventDefault();
            var data = new FormData($('#form')[0]);
            $("#submitform").attr('disabled', true);
            $("#submitform span").text(loading_text);

            $.ajax({
                url:"{{ route("admin.m_harga.update") }}",
                method:"POST",
                headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                data: data,
                processData: false,
                contentType: false,
                success:function(data)
                {
                    if($.isEmptyObject(data.error)){

                        if(data.status == true){
                            $("#submitform").removeAttr('disabled');
                            $("#submitform span").text('Submit');
                            $("form").each(function() { this.reset() });
                            swal.fire({
                                title: "Success",
                                text: data.message,
                                icon: "success"
                            }).then(function() {
                                location.href = data.redirect;
                            });
                        }else{
                            displayErrorSwal(data.message);
                        }

                    }else{
                        displayWarningSwal();
                        $("#submitform").removeAttr('disabled');
                        $("#submitform span").text('Submit');
                        $.each(data.error, function(key, value) {
                            var element = $("#" + key);
                            element.closest("div.form-control")
                            .removeClass("text-danger")
                            .addClass(value.length > 0 ? "text-danger" : "")
                            .find("#error_" + key).remove();
                            element.after("<div id=error_"+ key + " class=text-danger>" + value + "</div>");
                        });
                    }
                },
                error: function(data){
                    displayErrorSwal(data.message);
                }
            });
        });
    });

</script>
@endsection
