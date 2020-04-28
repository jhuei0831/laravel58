@extends('_layouts.manage.app')
@section('title',trans('Backstage'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card border-secondary">
                <div class="card-header"><h3><strong>{{ trans('Backstage').trans('Introduction') }}</strong></h3></div>
                <div class="card-body">
                    <div class="card border-primary">
                        <div class="card-header bg-transparent">
                            <h3><strong>{{ trans('Function').trans('Introduction') }}</strong></h3>
                            <ul class="nav nav-tabs" id="funcTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="navbar-tab" data-toggle="tab" href="#navbar" role="tab" aria-controls="navbar" aria-selected="true">{{ trans('Navbar') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="menu-tab" data-toggle="tab" href="#menu" role="tab" aria-controls="menu" aria-selected="false">{{ trans('Menu') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="page-tab" data-toggle="tab" href="#page" role="tab" aria-controls="page" aria-selected="false">{{ trans('Page') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="slide-tab" data-toggle="tab" href="#slide" role="tab" aria-controls="slide" aria-selected="false">{{ trans('Slide') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="notice-tab" data-toggle="tab" href="#notice" role="tab" aria-controls="notice" aria-selected="false">{{ trans('Notice') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">{{ trans('Information') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="member-tab" data-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="false">{{ trans('Member') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="config-tab" data-toggle="tab" href="#config" role="tab" aria-controls="config" aria-selected="false">{{ trans('Config') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="log-tab" data-toggle="tab" href="#log" role="tab" aria-controls="log" aria-selected="false">Log</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sort-tab" data-toggle="tab" href="#sort" role="tab" aria-controls="sort" aria-selected="false">{{ trans('Sort') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="funcTabContent">
                                <div class="tab-pane fade show active" id="navbar" role="tabpanel" aria-labelledby="navbar-tab">
                                    <p>
                                        <ul>
                                            <li>導覽名稱唯一(Unique)。</li>
                                            <li>導覽目錄</li>
                                            <ol>
                                                <li>下拉式選單，無視設定連結。</li>
                                                <li>選單內容可以在<mark>選單管理</mark>進行排序設定。</li>
                                            </ol>
                                            <li>一般頁面</li>
                                            <ol>
                                                <li>點選後直接跳到該頁面。</li>
                                                <li>外部連結直接貼完整網址，ex:https://www.sce.ntnu.edu.tw/home/</li>
                                                <li>指定頁面連結要透過指定格式，如<mark>{{Request::root()}}/article/導覽列名稱/選單名稱?頁面網址</mark>。</li>
                                            </ol>
                                        </ul>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                                    <p>
                                        <ul>
                                            <li>選單名稱唯一(Unique)。</li>
                                            <li>如有設定連結，點擊選單則跳轉到該頁面。</li>
                                            <li>清單顯示意指所有<mark>頁面設定</mark>連接該選單的頁面以條列式一一顯示。</li>
                                            <li>非清單顯示意指顯示<mark>更新時間</mark>最新的頁面。</li>
                                            <li>連結設定請參照導覽列。</li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="page" role="tabpanel" aria-labelledby="page-tab">
                                    <p>
                                        <ul>
                                            <li>頁面網址唯一(Unique)。</li>
                                            <li>頁面網址用來定義該頁面位置，所以只須給名稱即可，ex:Page1。</li>
                                            <li>在選單的清單顯示中，頁面以<mark>更新時間</mark>新到舊進行排序。</li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="slide" role="tabpanel" aria-labelledby="slide-tab">
                                    <p>
                                        <ul>
                                            <li>圖片請使用媒體管理<mark>縮放</mark>成統一大小。</li>
                                            <li>選單不會進行輪播，頁面才會。</li>
                                            <li>連結設定請參照導覽列。</li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="notice" role="tabpanel" aria-labelledby="notice-tab">
                                    <p>
                                        <ul>
                                            <li>一個選單只能顯示一個通知，以<mark>更新時間</mark>最新一筆顯示。</li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                                    <p>
                                        <ul>
                                            <li>只有置頂消息可以進行手動排序，其他消息以更新時間自動排序。</li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">
                                    <p>
                                        <ul>
                                            <li>電子郵件唯一(Unique)。</li>
                                            <li>需要進行信箱驗證的會員:前台註冊、進入後台。</li>
                                            <li>一般使用者只有前台使用的權限。</li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="config" role="tabpanel" aria-labelledby="config-tab">
                                    <p>
                                        <ul>
                                            <li>此設定只針對前台。</li>
                                            <li>若設定不開放網站，則會跳出錯誤頁面<mark>(目前為403)</mark>。</li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="log" role="tabpanel" aria-labelledby="log-tab">
                                    <p>
                                        <ul>
                                            <li>後台所有<mark>新增、修改、刪除</mark>都會被做紀錄。</li>
                                        </ul>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="sort" role="tabpanel" aria-labelledby="sort-tab">
                                    <p>
                                        <ul>
                                            <li>可以排序的功能為<mark>導覽列</mark>、<mark>選單</mark>、<mark>輪播</mark>、<mark>置頂消息</mark>。</li>
                                            <li>進入排序頁面後直接拖曳目標後即完成排序動作。</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="card border-primary">
                        <div class="card-header bg-transparent">
                            <h3><strong>使用情境</strong></h3>
                            <ul class="nav nav-tabs" id="useTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="navbar1-tab" data-toggle="tab" href="#navbar1" role="tab" aria-controls="navbar1" aria-selected="true">{{ trans('Navbar') }}1</a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="navbar2-tab" data-toggle="tab" href="#navbar2" role="tab" aria-controls="navbar2" aria-selected="false">{{ trans('Navbar') }}2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="navbar3-tab" data-toggle="tab" href="#navbar3" role="tab" aria-controls="navbar3" aria-selected="false">{{ trans('Navbar') }}3</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="useTabContent">
                                <div class="tab-pane fade show active" id="navbar1" role="tabpanel" aria-labelledby="navbar1-tab">
                                    <p>
                                        <ul>
                                            <li>點導覽列<mark>Nav1</mark>直接到Google搜尋頁。</li>
                                            <ol>
                                                <li>新增導覽列</li>
                                                <li><mark>導覽列名稱</mark>輸入: Nav1</li>
                                                <li><mark>連結</mark>輸入: https://www.google.com/</li>
                                                <li><mark>類型</mark>選擇: 一般頁面</li>
                                            </ol>
                                        </ul>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="navbar2" role="tabpanel" aria-labelledby="navbar2-tab">
                                    <p>
                                        <ul>
                                            <li>點導覽列<mark>Nav1</mark>到選單<mark>Menu1</mark></li>
                                            <ol>
                                                <li>確認導覽列<mark>Nav1</mark>存在並且設定開放</li>
                                                <li>修改導覽列<mark>連結</mark>為: {{Request::root()}}/article/Nav1/Menu1</li>
                                                <li>新增選單</li>
                                                <li><mark>選單名稱</mark>輸入:　Menu1</li>
                                                <li><mark>導覽列</mark>選擇: Nav1</li>
                                            </ol>
                                        </ul>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="navbar3" role="tabpanel" aria-labelledby="navbar3-tab">
                                    <p>
                                        <ul>
                                            <li>點導覽列<mark>Nav1</mark>到選單<mark>Menu1</mark>中的頁面<mark>Page1</mark></li>
                                            <ol>
                                                <li>確認導覽列<mark>Nav1</mark>選單<mark>Menu1</mark>存在並且設定開放</li>
                                                <li>修改導覽列<mark>連結</mark>為: {{Request::root()}}/article/Nav1/Menu1/Page1</li>
                                                <li>新增頁面</li>
                                                <li><mark>選單</mark>選擇: Menu1</li>
                                                <li><mark>頁面網址</mark>輸入: Page1</li>
                                            </ol>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
