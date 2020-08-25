

<div id="modalSubModel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Нөөц дуусч буй сумууд</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modalSubModel" action=1"" method="post">
            <div class="modal-body">
                @csrf
                <table id="FoodReserveTable" class="table table-striped table-bordered wrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                      <tr>

                        <th>Аймаг, нийслэл</th>
                        <th style="width:18%;">Сум, Дүүрэг</th>
                        <th>Гол нэрийн бүтээгдхүүн</th>
                        <th>Үлдсэн хоног</th>
                        <th>Арга хэмжээ</th>
                        <th>Арга хэмжээ</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Архангай</td>
                        <td>Батцэнгэл</td>
                        <td>Төмс</td>
                        <td style="font-color:red;">2</td>
                        <td>
                          <input type="button" class="btn btn-warning" name="" value="Орлуулах">
                        </td>
                        <td>
                          <input type="button" class="btn btn-danger" name="" value="Хасах">
                        </td>
                      </tr>
                      <tr>
                        <td>Завхан</td>
                        <td>Тосонцэнгэл</td>
                        <td>Гурил</td>
                        <td style="font-color:red;">1</td>
                        <td>
                          <input type="button" class="btn btn-warning" name="" value="Орлуулах">
                        </td>
                        <td>
                          <input type="button" class="btn btn-danger" name="" value="Хасах">
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                {{-- <button type="submit" id="btnOrgAdd" class="btn btn-primary">Хадгалах</button> --}}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
