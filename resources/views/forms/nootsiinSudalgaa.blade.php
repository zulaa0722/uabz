@extends('layouts.layout_master')
@section('css')
<link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
<link href="{{url('public/uaBCssJs/dropzone/dropzone.min.css')}}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                <div id="changeBlade" class="card-body">
                  <table id="dataTable1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                      <thead>
                        <tr>
                          <th>N</th>
                          <th>Аймаг, нийслэл</th>
                          <th>Сум, Дүүрэг</th>
                          <th>Хэмжих нэгж</th>
                          <th>Малын мах</th>
                          <th>Гурил</th>
                          <th>Төрөл бүрийн будаа</th>
                          <th>Хуурай сүү</th>
                          <th>Элсэн чихэр</th>
                          <th>Ургамлын тос</th>
                          <th>Төмс</th>
                          <th>Хүнсний ногоо</th>
                          <th>Давс</th>
                          <th>Савласан ус</th>
                        </tr>
                      </thead>

                  <tbody>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Багануур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>100тн</td>
                      <td>200тн</td>
                      <td>1 тн</td>
                      <td>3 тн</td>
                      <td>200 л</td>
                      <td>300 л</td>
                      <td>10 тн</td>
                      <td>10 кг</td>
                      <td>100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Баянзүрх</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>5 тн</td>
                      <td>3 тн</td>
                      <td>600 л</td>
                      <td>3200 л</td>
                      <td>120 тн</td>
                      <td>30 кг</td>
                      <td>500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Дархан</td>
                      <td>Дархан уул</td>
                      <td>л</td>
                      <td>Ямаа </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>3 тн</td>
                      <td>6 тн</td>
                      <td>7600 л</td>
                      <td>3400 л</td>
                      <td>120 тн</td>
                      <td>110 кг</td>
                      <td>1300 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Сэлэнгэ</td>
                      <td>Хан-Уул</td>
                      <td>Ш</td>
                      <td>Адуу </td>
                      <td>1020тн</td>
                      <td>12200тн</td>
                      <td>112 тн</td>
                      <td>33 тн</td>
                      <td>21200 л</td>
                      <td>30120 л</td>
                      <td>1330 тн</td>
                      <td>1210 кг</td>
                      <td>45100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Ховд</td>
                      <td>Шанд</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>14 тн</td>
                      <td>33 тн</td>
                      <td>1200 л</td>
                      <td>4300 л</td>
                      <td>510 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Завхан</td>
                      <td>Жаргалант</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>11 тн</td>
                      <td>34 тн</td>
                      <td>2100 л</td>
                      <td>3300 л</td>
                      <td>120 тн</td>
                      <td>1540 кг</td>
                      <td>1500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Хөвсгөл</td>
                      <td>Мөрөн</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>3100тн</td>
                      <td>5200тн</td>
                      <td>61 тн</td>
                      <td>23 тн</td>
                      <td>3200 л</td>
                      <td>5300 л</td>
                      <td>610 тн</td>
                      <td>110 кг</td>
                      <td>5100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Увс</td>
                      <td>Хар ус нуур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>5100тн</td>
                      <td>7200тн</td>
                      <td>21 тн</td>
                      <td>53 тн</td>
                      <td>6200 л</td>
                      <td>2300 л</td>
                      <td>410 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Багануур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>100тн</td>
                      <td>200тн</td>
                      <td>1 тн</td>
                      <td>3 тн</td>
                      <td>200 л</td>
                      <td>300 л</td>
                      <td>10 тн</td>
                      <td>10 кг</td>
                      <td>100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Баянзүрх</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>5 тн</td>
                      <td>3 тн</td>
                      <td>600 л</td>
                      <td>3200 л</td>
                      <td>120 тн</td>
                      <td>30 кг</td>
                      <td>500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Дархан</td>
                      <td>Дархан уул</td>
                      <td>л</td>
                      <td>Ямаа </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>3 тн</td>
                      <td>6 тн</td>
                      <td>7600 л</td>
                      <td>3400 л</td>
                      <td>120 тн</td>
                      <td>110 кг</td>
                      <td>1300 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Сэлэнгэ</td>
                      <td>Хан-Уул</td>
                      <td>Ш</td>
                      <td>Адуу </td>
                      <td>1020тн</td>
                      <td>12200тн</td>
                      <td>112 тн</td>
                      <td>33 тн</td>
                      <td>21200 л</td>
                      <td>30120 л</td>
                      <td>1330 тн</td>
                      <td>1210 кг</td>
                      <td>45100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Ховд</td>
                      <td>Шанд</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>14 тн</td>
                      <td>33 тн</td>
                      <td>1200 л</td>
                      <td>4300 л</td>
                      <td>510 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Завхан</td>
                      <td>Жаргалант</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>11 тн</td>
                      <td>34 тн</td>
                      <td>2100 л</td>
                      <td>3300 л</td>
                      <td>120 тн</td>
                      <td>1540 кг</td>
                      <td>1500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Хөвсгөл</td>
                      <td>Мөрөн</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>3100тн</td>
                      <td>5200тн</td>
                      <td>61 тн</td>
                      <td>23 тн</td>
                      <td>3200 л</td>
                      <td>5300 л</td>
                      <td>610 тн</td>
                      <td>110 кг</td>
                      <td>5100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Увс</td>
                      <td>Хар ус нуур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>5100тн</td>
                      <td>7200тн</td>
                      <td>21 тн</td>
                      <td>53 тн</td>
                      <td>6200 л</td>
                      <td>2300 л</td>
                      <td>410 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Багануур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>100тн</td>
                      <td>200тн</td>
                      <td>1 тн</td>
                      <td>3 тн</td>
                      <td>200 л</td>
                      <td>300 л</td>
                      <td>10 тн</td>
                      <td>10 кг</td>
                      <td>100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Баянзүрх</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>5 тн</td>
                      <td>3 тн</td>
                      <td>600 л</td>
                      <td>3200 л</td>
                      <td>120 тн</td>
                      <td>30 кг</td>
                      <td>500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Дархан</td>
                      <td>Дархан уул</td>
                      <td>л</td>
                      <td>Ямаа </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>3 тн</td>
                      <td>6 тн</td>
                      <td>7600 л</td>
                      <td>3400 л</td>
                      <td>120 тн</td>
                      <td>110 кг</td>
                      <td>1300 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Сэлэнгэ</td>
                      <td>Хан-Уул</td>
                      <td>Ш</td>
                      <td>Адуу </td>
                      <td>1020тн</td>
                      <td>12200тн</td>
                      <td>112 тн</td>
                      <td>33 тн</td>
                      <td>21200 л</td>
                      <td>30120 л</td>
                      <td>1330 тн</td>
                      <td>1210 кг</td>
                      <td>45100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Ховд</td>
                      <td>Шанд</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>14 тн</td>
                      <td>33 тн</td>
                      <td>1200 л</td>
                      <td>4300 л</td>
                      <td>510 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Завхан</td>
                      <td>Жаргалант</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>11 тн</td>
                      <td>34 тн</td>
                      <td>2100 л</td>
                      <td>3300 л</td>
                      <td>120 тн</td>
                      <td>1540 кг</td>
                      <td>1500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Хөвсгөл</td>
                      <td>Мөрөн</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>3100тн</td>
                      <td>5200тн</td>
                      <td>61 тн</td>
                      <td>23 тн</td>
                      <td>3200 л</td>
                      <td>5300 л</td>
                      <td>610 тн</td>
                      <td>110 кг</td>
                      <td>5100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Увс</td>
                      <td>Хар ус нуур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>5100тн</td>
                      <td>7200тн</td>
                      <td>21 тн</td>
                      <td>53 тн</td>
                      <td>6200 л</td>
                      <td>2300 л</td>
                      <td>410 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Багануур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>100тн</td>
                      <td>200тн</td>
                      <td>1 тн</td>
                      <td>3 тн</td>
                      <td>200 л</td>
                      <td>300 л</td>
                      <td>10 тн</td>
                      <td>10 кг</td>
                      <td>100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Баянзүрх</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>5 тн</td>
                      <td>3 тн</td>
                      <td>600 л</td>
                      <td>3200 л</td>
                      <td>120 тн</td>
                      <td>30 кг</td>
                      <td>500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Дархан</td>
                      <td>Дархан уул</td>
                      <td>л</td>
                      <td>Ямаа </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>3 тн</td>
                      <td>6 тн</td>
                      <td>7600 л</td>
                      <td>3400 л</td>
                      <td>120 тн</td>
                      <td>110 кг</td>
                      <td>1300 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Сэлэнгэ</td>
                      <td>Хан-Уул</td>
                      <td>Ш</td>
                      <td>Адуу </td>
                      <td>1020тн</td>
                      <td>12200тн</td>
                      <td>112 тн</td>
                      <td>33 тн</td>
                      <td>21200 л</td>
                      <td>30120 л</td>
                      <td>1330 тн</td>
                      <td>1210 кг</td>
                      <td>45100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Ховд</td>
                      <td>Шанд</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>14 тн</td>
                      <td>33 тн</td>
                      <td>1200 л</td>
                      <td>4300 л</td>
                      <td>510 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Завхан</td>
                      <td>Жаргалант</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>11 тн</td>
                      <td>34 тн</td>
                      <td>2100 л</td>
                      <td>3300 л</td>
                      <td>120 тн</td>
                      <td>1540 кг</td>
                      <td>1500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Хөвсгөл</td>
                      <td>Мөрөн</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>3100тн</td>
                      <td>5200тн</td>
                      <td>61 тн</td>
                      <td>23 тн</td>
                      <td>3200 л</td>
                      <td>5300 л</td>
                      <td>610 тн</td>
                      <td>110 кг</td>
                      <td>5100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Увс</td>
                      <td>Хар ус нуур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>5100тн</td>
                      <td>7200тн</td>
                      <td>21 тн</td>
                      <td>53 тн</td>
                      <td>6200 л</td>
                      <td>2300 л</td>
                      <td>410 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Багануур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>100тн</td>
                      <td>200тн</td>
                      <td>1 тн</td>
                      <td>3 тн</td>
                      <td>200 л</td>
                      <td>300 л</td>
                      <td>10 тн</td>
                      <td>10 кг</td>
                      <td>100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Баянзүрх</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>5 тн</td>
                      <td>3 тн</td>
                      <td>600 л</td>
                      <td>3200 л</td>
                      <td>120 тн</td>
                      <td>30 кг</td>
                      <td>500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Дархан</td>
                      <td>Дархан уул</td>
                      <td>л</td>
                      <td>Ямаа </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>3 тн</td>
                      <td>6 тн</td>
                      <td>7600 л</td>
                      <td>3400 л</td>
                      <td>120 тн</td>
                      <td>110 кг</td>
                      <td>1300 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Сэлэнгэ</td>
                      <td>Хан-Уул</td>
                      <td>Ш</td>
                      <td>Адуу </td>
                      <td>1020тн</td>
                      <td>12200тн</td>
                      <td>112 тн</td>
                      <td>33 тн</td>
                      <td>21200 л</td>
                      <td>30120 л</td>
                      <td>1330 тн</td>
                      <td>1210 кг</td>
                      <td>45100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Ховд</td>
                      <td>Шанд</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>14 тн</td>
                      <td>33 тн</td>
                      <td>1200 л</td>
                      <td>4300 л</td>
                      <td>510 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Завхан</td>
                      <td>Жаргалант</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>11 тн</td>
                      <td>34 тн</td>
                      <td>2100 л</td>
                      <td>3300 л</td>
                      <td>120 тн</td>
                      <td>1540 кг</td>
                      <td>1500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Хөвсгөл</td>
                      <td>Мөрөн</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>3100тн</td>
                      <td>5200тн</td>
                      <td>61 тн</td>
                      <td>23 тн</td>
                      <td>3200 л</td>
                      <td>5300 л</td>
                      <td>610 тн</td>
                      <td>110 кг</td>
                      <td>5100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Увс</td>
                      <td>Хар ус нуур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>5100тн</td>
                      <td>7200тн</td>
                      <td>21 тн</td>
                      <td>53 тн</td>
                      <td>6200 л</td>
                      <td>2300 л</td>
                      <td>410 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Багануур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>100тн</td>
                      <td>200тн</td>
                      <td>1 тн</td>
                      <td>3 тн</td>
                      <td>200 л</td>
                      <td>300 л</td>
                      <td>10 тн</td>
                      <td>10 кг</td>
                      <td>100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Баянзүрх</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>5 тн</td>
                      <td>3 тн</td>
                      <td>600 л</td>
                      <td>3200 л</td>
                      <td>120 тн</td>
                      <td>30 кг</td>
                      <td>500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Дархан</td>
                      <td>Дархан уул</td>
                      <td>л</td>
                      <td>Ямаа </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>3 тн</td>
                      <td>6 тн</td>
                      <td>7600 л</td>
                      <td>3400 л</td>
                      <td>120 тн</td>
                      <td>110 кг</td>
                      <td>1300 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Сэлэнгэ</td>
                      <td>Хан-Уул</td>
                      <td>Ш</td>
                      <td>Адуу </td>
                      <td>1020тн</td>
                      <td>12200тн</td>
                      <td>112 тн</td>
                      <td>33 тн</td>
                      <td>21200 л</td>
                      <td>30120 л</td>
                      <td>1330 тн</td>
                      <td>1210 кг</td>
                      <td>45100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Ховд</td>
                      <td>Шанд</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>14 тн</td>
                      <td>33 тн</td>
                      <td>1200 л</td>
                      <td>4300 л</td>
                      <td>510 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Завхан</td>
                      <td>Жаргалант</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>11 тн</td>
                      <td>34 тн</td>
                      <td>2100 л</td>
                      <td>3300 л</td>
                      <td>120 тн</td>
                      <td>1540 кг</td>
                      <td>1500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Хөвсгөл</td>
                      <td>Мөрөн</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>3100тн</td>
                      <td>5200тн</td>
                      <td>61 тн</td>
                      <td>23 тн</td>
                      <td>3200 л</td>
                      <td>5300 л</td>
                      <td>610 тн</td>
                      <td>110 кг</td>
                      <td>5100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Увс</td>
                      <td>Хар ус нуур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>5100тн</td>
                      <td>7200тн</td>
                      <td>21 тн</td>
                      <td>53 тн</td>
                      <td>6200 л</td>
                      <td>2300 л</td>
                      <td>410 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr><tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Багануур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>100тн</td>
                      <td>200тн</td>
                      <td>1 тн</td>
                      <td>3 тн</td>
                      <td>200 л</td>
                      <td>300 л</td>
                      <td>10 тн</td>
                      <td>10 кг</td>
                      <td>100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Улаанбаатар</td>
                      <td>Баянзүрх</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>5 тн</td>
                      <td>3 тн</td>
                      <td>600 л</td>
                      <td>3200 л</td>
                      <td>120 тн</td>
                      <td>30 кг</td>
                      <td>500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Дархан</td>
                      <td>Дархан уул</td>
                      <td>л</td>
                      <td>Ямаа </td>
                      <td>400тн</td>
                      <td>600тн</td>
                      <td>3 тн</td>
                      <td>6 тн</td>
                      <td>7600 л</td>
                      <td>3400 л</td>
                      <td>120 тн</td>
                      <td>110 кг</td>
                      <td>1300 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Сэлэнгэ</td>
                      <td>Хан-Уул</td>
                      <td>Ш</td>
                      <td>Адуу </td>
                      <td>1020тн</td>
                      <td>12200тн</td>
                      <td>112 тн</td>
                      <td>33 тн</td>
                      <td>21200 л</td>
                      <td>30120 л</td>
                      <td>1330 тн</td>
                      <td>1210 кг</td>
                      <td>45100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Ховд</td>
                      <td>Шанд</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>14 тн</td>
                      <td>33 тн</td>
                      <td>1200 л</td>
                      <td>4300 л</td>
                      <td>510 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Завхан</td>
                      <td>Жаргалант</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>1200тн</td>
                      <td>2300тн</td>
                      <td>11 тн</td>
                      <td>34 тн</td>
                      <td>2100 л</td>
                      <td>3300 л</td>
                      <td>120 тн</td>
                      <td>1540 кг</td>
                      <td>1500 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Хөвсгөл</td>
                      <td>Мөрөн</td>
                      <td>Ш</td>
                      <td>Хонь </td>
                      <td>3100тн</td>
                      <td>5200тн</td>
                      <td>61 тн</td>
                      <td>23 тн</td>
                      <td>3200 л</td>
                      <td>5300 л</td>
                      <td>610 тн</td>
                      <td>110 кг</td>
                      <td>5100 л</td>
                    </tr>
                    <tr>
                      <td>N</td>
                      <td>Увс</td>
                      <td>Хар ус нуур</td>
                      <td>Ш</td>
                      <td>Үхэр </td>
                      <td>5100тн</td>
                      <td>7200тн</td>
                      <td>21 тн</td>
                      <td>53 тн</td>
                      <td>6200 л</td>
                      <td>2300 л</td>
                      <td>410 тн</td>
                      <td>610 кг</td>
                      <td>1100 л</td>
                    </tr>
                  </tbody>
                  </table>

                </div>
              </div>
          </div>
      </div>
    </div>
  </div>


@endsection



@section('js')
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>

  <script src="{{url('public/uaBCssJs/dropzone/dropzone.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function(){
  $('#dataTable1').DataTable( {
      });
});
</script>

@endsection
