<?php

namespace App\Traits;
use App\Models\CarStatus;

trait menu {
  public function home() {

    $menu = [
      [
        'name'  => __('admin.admins'),
        'count' => \App\Models\Admin::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/admins'),
        'route'   => 'admin.admins.index',
      ], [
        'name'  => __('admin.clients'),
        'count' => \App\Models\User::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients-show'),
        'route'   => 'admin.clients.index',
      ], [
        'name'  => __('admin.active_users'),
        'count' => \App\Models\User::where('is_approved', 1)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients-show'),
        'route'   => 'admin.clients.index',
      ], [
        'name'  =>  __('admin.dis_active_users'),
        'count' => \App\Models\User::where('is_approved', 0)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients-show'),
        'route'   => 'admin.clients.index',
      ], [
        'name'  => __('admin.Unspoken_users'),
        'count' => \App\Models\User::where('is_blocked', 0)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients-show'),
        'route'   => 'admin.clients.index',
      ], [
        'name'  => __('admin.Prohibited_users'),
        'count' => \App\Models\User::where('is_blocked', 1)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients-show'),
        'route'   => 'admin.clients.index',
      ],
      [
        'name'  => __('admin.main_users'),
        'count' => \App\Models\User::whereNull('parent_id')->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients-show'),
        'route'   => 'admin.clients.index',
      ],
      [
        'name'  => __('admin.sub_users'),
        'count' => \App\Models\User::whereNotNull('parent_id')->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients-show'),
        'route'   => 'admin.clients.index',
      ],
      [
        'name'  => __('admin.vip_users'),
        'count' => \App\Models\User::where('vip', 1)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients-show'),
        'route'   => 'admin.clients.index',
      ],
      [
        'name'  => __('admin.middle_users'),
        'count' => \App\Models\User::where('middle', 1)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients-show'),
        'route'   => 'admin.clients.index',
      ],
      [
        'name'  => __('admin.usual_users'),
        'count' => \App\Models\User::where('usual', 1)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients-show'),
        'route'   => 'admin.clients.index',
      ],
      [
        'name'  => __('admin.sections'),
        'count' => \App\Models\Category::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/categories-show'),
        'route'   => 'admin.',
      ],
      [
        'name'  => __('admin.pricecategories'),
        'count' => \App\Models\PriceCategories::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/pricecategories'),
        'route'   => 'admin.categories.index',
      ],
      [
        'name'  => __('admin.pricetypes'),
        'count' => \App\Models\PriceTypes::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/pricetypes'),
        'route'   => 'admin.pricetypes.index',
      ],
      [
        'name'  => __('admin.shippngpricelists'),
        'count' => \App\Models\ShippngPriceList::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/shippngpricelists'),
        'route'   => 'admin.shippngpricelists.index',
      ],
      [
        'name'  => __('admin.news'),
        'count' => \App\Models\News::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/news'),
        'route'   => 'admin.news.index',
      ],
      [
        'name'  => __('admin.socials'),
        'count' => \App\Models\Social::count(),
        'icon'  => 'icon-thumbs-up',
        'url'   => url('admin/socials'),
        'route'   => 'admin.socials.index',
      ], [
        'name'  => __('admin.complaints_and_proposals'),
        'count' => \App\Models\Complaint::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/all-complaints'),
        'route'   => 'admin.all_complaints',
      ], [
        'name'  => __('admin.reports'),
        'count' => \App\Models\LogActivity::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/reports'),
        'route'   => 'admin.reports.index',
      ], [
        'name'  => __('admin.countries'),
        'count' => \App\Models\Country::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/countries'),
        'route'   => 'admin.countries.index',
      ],
      [
        'name'  => __('admin.regions'),
        'count' => \App\Models\Region::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/regions'),
        'route'   => 'admin.regions.index',
      ],
      [
        'name'  => __('admin.cities'),
        'count' => \App\Models\City::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/cities'),
        'route'   => 'admin.cities.index',
      ], [
        'name'  => __("admin.common_questions"),
        'count' => \App\Models\Fqs::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/fqs'),
        'route'   => 'admin.fqs.index',
      ], [
        'name'  => __('admin.definition_pages'),
        'count' => \App\Models\Intro::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/intros'),
        'route'   => 'admin.intros.index',
      ], [
        'name'  => __('admin.advertising_banners'),
        'count' => \App\Models\Image::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/images'),
        'route'   => 'admin.images.index',
      ],
      [
        'name'  => __('admin.Validities'),
        'count' => \App\Models\Role::count(),
        'icon'  => 'icon-eye',
        'url'   => url('admin/roles'),
        'route'   => 'admin.roles.index',
      ],
      [
        'name'  => __('admin.carfinanceoperations'),
        'count' => \App\Models\CarFinanceOperations::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/carfinanceoperations'),
        'route'   => 'admin.carfinanceoperations.index',
      ],
      [
        'name'  => __('admin.carstatuses'),
        'count' => \App\Models\CarStatus::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/carstatuses'),
        'route'   => 'admin.carstatuses.index',
      ],
      [
        'name'  => __('admin.auctions'),
        'count' => \App\Models\Auction::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/auctions'),
        'route'   => 'admin.auctions.index',
      ],
      [
        'name'  => __('admin.warehouses'),
        'count' => \App\Models\Warehouse::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/warehouses'),
        'route'   => 'admin.warehouses.index',
      ],
      [
        'name'  => __('admin.branches'),
        'count' => \App\Models\Branch::count(),
        'icon'  => 'icon-home',
        'url'   => url('admin/branches'),
        'route'   => 'admin.branches.index',
      ],
      [
        'name'  => __('admin.cars'),
        'count' => \App\Models\Car::count(),
        'icon'  => 'icon-truck',
        'url'   => url('admin/cars'),
        'route'   => 'admin.cars.index',
      ],

    ];
    $statuses = CarStatus::orderBy('sort','ASC')->get();
    foreach($statuses as $status){
        $menu[] =  [  'name'  => $status->name,
                      'count' => \App\Models\Car::where('car_status_id',$status->id)->count(),
                      'icon'  => 'icon-truck',
                      'url'   => url('admin/cars/status/'.$status->id),
                      'route'   => 'admin.cars.carsByStatus.'.$status->id,
                    ];
    }
    return $menu;
  }

  public function introSiteCards() {
    $menu = [
      [
        'name'  => __('admin.insolder'),
        'count' => \App\Models\IntroSlider::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introsliders'),
      ],
      [
        'name'  => __('admin.Service_Suite'),
        'count' => \App\Models\IntroService::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introservices'),
      ],
      [
        'name'  => __('admin.questions_sections'),
        'count' => \App\Models\IntroFqsCategory::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introfqscategories'),
      ],
      [
        'name'  => __('admin.common_questions'),
        'count' => \App\Models\IntroFqs::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introfqs'),
      ],
      [
        'name'  => __('admin.Success_Partners'),
        'count' => \App\Models\IntroPartener::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introparteners'),
      ],
      [
        'name'  => __('admin.Customer_messages'),
        'count' => \App\Models\IntroMessages::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/intromessages'),
      ],
      [
        'name'  => __('admin.socials'),
        'count' => \App\Models\IntroSocial::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introsocials'),
      ],
      [
        'name'  => __('admin.how_the_site_works_section'),
        'count' => \App\Models\IntroHowWork::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introhowworks'),
      ],
    ];
    return $menu;
  }

}