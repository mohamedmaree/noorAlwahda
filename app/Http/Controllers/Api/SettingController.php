<?php

namespace App\Http\Controllers\Api;
use App\Models\Fqs;
use App\Models\City;
use App\Models\Image;
use App\Models\Intro;
use App\Models\Order;
use App\Models\Social;
use App\Models\Country;
use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\Region;
use App\Traits\ResponseTrait;
use App\Services\CouponService;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Coupon\checkCouponRequest;
use App\Http\Resources\Api\Settings\SocialResource;
use App\Http\Resources\Api\Settings\FqsResource;
use App\Http\Resources\Api\Settings\CityResource;
use App\Http\Resources\Api\Settings\ImageResource;
use App\Http\Resources\Api\Settings\IntroResource;
use App\Http\Resources\Api\Settings\CountryResource;
use App\Http\Resources\Api\Settings\CategoryResource;
use App\Http\Resources\Api\Settings\CountryWithCitiesResource;
use App\Http\Resources\Api\Settings\CountryWithRegionsResource;
use App\Http\Resources\Api\Settings\RegionResource;
use App\Http\Resources\Api\Settings\RegionWithCitiesResource;
use Illuminate\Http\Request;
use App\Models\AppHome;
use App\Http\Resources\Api\Settings\AppHomeResource;
use App\Models\CarStatus;
use App\Http\Resources\Api\Settings\CarStatusResource;
use App\Models\DamageTypes;
use App\Http\Resources\Api\Settings\DamageTypesResource;
use App\Models\PriceTypes;
use App\Http\Resources\Api\Settings\PriceTypesResource;
use App\Models\CarBrands;
use App\Http\Resources\Api\Settings\CarBrandsResource;
use App\Http\Resources\Api\Settings\CarBrandsWithModelsResource;
use App\Models\CarModels;
use App\Http\Resources\Api\Settings\CarModelsResource;
use App\Models\CarColors;
use App\Http\Resources\Api\Settings\CarColorsResource;
use App\Models\CarYears;
use App\Http\Resources\Api\Settings\CarYearsResource;
use App\Models\BodyTypes;
use App\Http\Resources\Api\Settings\BodyTypesResource;
use App\Models\EngineTypes;
use App\Http\Resources\Api\Settings\EngineTypesResource;
use App\Models\EngineCylinders;
use App\Http\Resources\Api\Settings\EngineCylindersResource;
use App\Models\transmissionTypes;
use App\Http\Resources\Api\Settings\transmissionTypesResource;
use App\Models\DriveTypes;
use App\Http\Resources\Api\Settings\DriveTypesResource;
use App\Models\FuelTypes;
use App\Http\Resources\Api\Settings\FuelTypesResource;
use App\Models\News;
use App\Http\Resources\Api\Settings\NewsResource;

class SettingController extends Controller {
  use ResponseTrait;

  public function settings() {
    $data = SettingService::appInformations(SiteSetting::pluck('value', 'key'));
    return $this->successData($data);
  }

  public function about() {
    $about = SiteSetting::where(['key' => 'about_' . lang()])->first()->value;
    return $this->successData( $about);
  }

  public function terms() {
    $terms = SiteSetting::where(['key' => 'terms_' . lang()])->first()->value;
    return $this->successData( $terms);
  }

  public function privacy() {
    $privacy = SiteSetting::where(['key' => 'privacy_' . lang()])->first()->value;
    return $this->successData( $privacy);
  }

  public function intros() {
    $intros = IntroResource::collection(Intro::latest()->get());
    return $this->successData( $intros);
  }

  public function fqss() {
    $fqss = FqsResource::collection(Fqs::latest()->get());
    return $this->successData( $fqss);
  }

  public function socials() {
    $socials = SocialResource::collection(Social::latest()->get());
    return $this->successData( $socials);
  }

  public function images($id = null) {
    $images = ImageResource::collection(Image::where('is_active',1)->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->orderBy('sort','ASC')->get());
    return $this->successData( $images);
    //$images = ImageResource::collection(Image::paginate(1));
  }

  public function categories($id = null) {
    $categories = CategoryResource::collection(Category::where('is_active',1)->latest()->get());
    return $this->successData($categories);
  }

  public function countries() {
    $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
    $supported_countries = json_decode($supported_countries);
    $countries = CountryResource::collection(Country::whereIn('id',$supported_countries??[])->latest()->get());
    return $this->successData( $countries);
  }

  public function cities() {
    $cities = CityResource::collection(City::latest()->get());
    return $this->successData( $cities);
  }

  public function regions() {
    $regions = RegionResource::collection(Region::latest()->get());
    return $this->successData( $regions);
  }

  public function regionCities($region_id) {
    $cities = CityResource::collection(City::where('region_id', $region_id)->latest()->get());
    return $this->successData($cities);
  }

  public function regionsWithCities() {
    $regions = RegionWithCitiesResource::collection(Region::with('cities')->latest()->get());
    return $this->successData($regions);
  }

  public function CountryCities($country_id) {
    $cities = CityResource::collection(City::where('country_id', $country_id)->latest()->get());
    return $this->successData( $cities);
  }

  public function CountryRegions($country_id) {
    $regions = RegionResource::collection(Region::where('country_id', $country_id)->latest()->get());
    return $this->successData( $regions);
  }

  public function countriesWithCities() {
    $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
    $supported_countries = json_decode($supported_countries);
    $countries = CountryWithCitiesResource::collection(Country::whereIn('id',$supported_countries??[])->with('cities')->latest()->get());
    return $this->successData( $countries);
  }
  
  public function countriesWithRegions() {
    $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
    $supported_countries = json_decode($supported_countries);
    $countries = CountryWithRegionsResource::collection(Country::whereIn('id',$supported_countries??[])->with('regions')->latest()->get());
    return $this->successData( $countries);
  }

  public function checkCoupon(checkCouponRequest $request)
  {
    $checkCouponRes = CouponService::checkCoupon( $request->coupon_num , $request->total_price) ;
    return $this->response($checkCouponRes['key'] , $checkCouponRes['msg'] , $checkCouponRes['data'] ?? null);
  }
  public function isProduction()
  {
    $isProduction = SiteSetting::where(['key' => 'is_production'])->first()->value;
    return $this->successData($isProduction);
  }

  public function Home()
  {
    $home_sections = AppHome::active()->Published()->orderBy('sort','asc')->get();
    $home =  AppHomeResource::collection($home_sections);
    return $this->successData($home);
  }

  public function carStatus() {
    $CarStatus = CarStatusResource::collection(CarStatus::latest()->get());
    return $this->successData( $CarStatus);
  }

  public function damageTypes() {
    $DamageTypes = DamageTypesResource::collection(DamageTypes::latest()->get());
    return $this->successData( $DamageTypes);
  }

  public function priceTypes() {
    $PriceTypes = PriceTypesResource::collection(PriceTypes::latest()->get());
    return $this->successData( $PriceTypes);
  }
  
  public function carBrands() {
    $CarBrands = CarBrandsResource::collection(CarBrands::latest()->get());
    return $this->successData( $CarBrands);
  }

  public function carBrandsWithModels() {
    $CarBrands = CarBrandsWithModelsResource::collection(CarBrands::with('models')->latest()->get());
    return $this->successData( $CarBrands);
  }

  public function carModels(Request $request) {
    $CarModels = CarModelsResource::collection(CarModels::when($request->brand_id,function($q)use($request){
      return $q->where('car_brand_id',$request->brand_id);
    })->latest()->get());
    return $this->successData( $CarModels);
  }

  public function carColors() {
    $CarColors = CarColorsResource::collection(CarColors::latest()->get());
    return $this->successData( $CarColors);
  }

  public function carYears() {
    $CarYears = CarYearsResource::collection(CarYears::latest()->get());
    return $this->successData( $CarYears);
  }
  
  public function bodyTypes() {
    $BodyTypes = BodyTypesResource::collection(BodyTypes::latest()->get());
    return $this->successData( $BodyTypes);
  }

  public function engineTypes() {
    $EngineTypes = EngineTypesResource::collection(EngineTypes::latest()->get());
    return $this->successData( $EngineTypes);
  }
  
  public function engineCylinders() {
    $EngineCylinders = EngineCylindersResource::collection(EngineCylinders::latest()->get());
    return $this->successData( $EngineCylinders);
  }
  
  public function transmissionTypes() {
    $transmissionTypes = transmissionTypesResource::collection(transmissionTypes::latest()->get());
    return $this->successData( $transmissionTypes);
  }

  public function driveTypes() {
    $DriveTypes = DriveTypesResource::collection(DriveTypes::latest()->get());
    return $this->successData( $DriveTypes);
  }

  public function fuelTypes() {
    $FuelTypes = FuelTypesResource::collection(FuelTypes::latest()->get());
    return $this->successData( $FuelTypes);
  }

  public function news() {
    $news = NewsResource::collection(News::latest()->get());
    return $this->successData( $news);
  }
  
}
