<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Mail;
use App\Models\Article;//yazdigimiz modeli elave edirik
use App\Models\Categories;//yazdigimiz modeli elave edirik
use App\Models\Page;//yazdigimiz modeli elave edirik
use App\Models\Contact;//yazdigimiz modeli elave edirik
use App\Models\Ayarlar;//yazdigimiz modeli elave edirik


class Homepage extends Controller
{
   public function __construct()
   {
         if(Ayarlar::find(1)->durum==0){
               return redirect()->to('sayt-temirde')->send();
         }
         view()->share('pages',Page::where('durum',1)->orderBy('order','ASC')->get());
         //bu iki funksiyani her defe yeni funksiya yazanda elave etmeliyik ki,butun sehifler calissin..ona gore construct funksiyasinda yaziriq ki,sehife acilir acilmaz calissin..bunlarida diger funksiyalarda bagladiq..
         view()->share('categories',Categories::where('durum',1)->inRandomOrder()->get());
         view()->share('ayarlar',Ayarlar::find(1));//providers icindeki appserverden geldi..orda olanda migrate fresh etdikde xeta verir,ya githubdan yukluyende migrate yene etdikde yaranmir
   }
   public function index()
   {
       $data['xeber']=Article::with('getCategori')->whereHas('getCategori',function($query){
             $query->where('durum',1);//burda with ile category modeline baglandiq,ve ordan sorgu apardiq..wherehas ile geldik o tabloya ,bildirdik,ki durumu 1 olanlari goster..yeni categorisi bagli olan articli aciq olsa da gostermez
       })->where('durum',1)->orderBy('created_at','DESC')->paginate(2);//yazilari gostermek ,listelemek
       $data['xeber']->withPath(url('sayfa'));//paginationda urlni deyismek ucun yazilan koddu..elave route yazmaliyiq,withPath icinde url yazmasaqda calisir..geri donme ucun..meselen 3 cu sehifeye getdin geri donende islesin


       //$data['categories']=Categories::inRandomOrder()->get();//categorileri gormek ucun gonderilen sorgu..listelemek
         //baglandi,constructurda yazdiq

       //$data['pages']=Page::orderBy('order','ASC')->get();  //baglandi,constructda yazdiq
        return view('front.home',$data);
   }

   public function single($category,$slug)
   {
      $categori=Categories::whereSlug($category)->first() ?? abort(403,'Bele categori yoxdu');//bu srl de olmuyan kategori yazdiqda onun ucun yazilan sorgudu...if sorgusunu evez edir

        //ilkin veziyyet bele idi $data['article']=Article::whereSlug($slug)->first() ?? abort(403,'Bele sehife tapilmadi');//bununla biz url ucun bele bir slug var ya yox onu sorguladiq.. if evezidi.. burda duz olmuyan slug yazilanda xeta sehifesine atir
        $article=Article::whereSlug($slug)->whereCatId($categori->id)->first() ?? abort(403,'Bele sehife tapilmadi');//whereCatId($categori->id) burda bu kategoride bu yazinin olub olmadigini kontrol etdik elave yazdigimiz bu kodla..yeni urlde eylence kategorisinde bu adda bir xeber var meselen..urlde kategorini deyisib spor etsek xeta verir
        $article->increment('hit');//bu oxunma sayi ucun yazilan koddu..her defe girende bir dene artirir
        $data['article']=$article;

         //$data['categories']=Categories::inRandomOrder()->get();//yeni sehifede categories xetasi verir deye bunu da elave edirik
         //baglandi,constructurda yazdiq

         //$data['pages']=Page::orderBy('order','ASC')->get();  //baglandi,constructda yazdiq
         return view('front.single',$data);
   }

   public function category($slug)
   {
            $categori=Categories::whereSlug($slug)->first() ?? abort(403,'Bele categori yoxdu');
            $data['category']=$categori;
            $data['xeber']=Article::where('cat_id',$categori->id)->where('durum',1)->orderBy('created_at','DESC')->paginate(2);//burda get i paginate edirik

            //$data['categories']=Categories::inRandomOrder()->get();//categorileri gormek ucun gonderilen sorgu..listelemek
            //baglandi,constructurda yazdiq

            //$data['pages']=Page::orderBy('order','ASC')->get();  //baglandi,constructda yazdiq
            return view('front.category',$data);
   }

   public function page($slug)
   {
         $page=Page::whereSlug($slug)->first() ?? abort(403,'Bele pages bulunmadi');
         $data['page']=$page;//
        //$data['pages']=Page::orderBy('order','ASC')->get();  //baglandi,constructda yazdiq
         return view('front.page',$data);
   }


   public function contact()
   {
         return view('front.contact');
   }

   public function contactpost(Request $request)
   {
         $rules =$request->validate([
               //'adsoyad'=>'required |min:5',
               //'email'=>'email',
               //'mesaj'=> 'required | min:10',
               //'top' =>'required'
              
         ]);
         $validate=Validator::make($request->all(),$rules);
         if($validate->fails())
         {
               return redirect()->route('contact')->withErrors($validate)->withInput();
         }

         Mail::send([],[], function($message) use($request){//mail gondermek
               $message->from('elvin@gmail.com','Blog sitesi');
               $message->to('elvinesedullayev@gmail.com');
               $message->setBody('Mesaji Gonderen :'.$request->name.'<br>
                                 Mesaji Gonderen Mail : '.$request->mail.'<br>
                                 Mesaj Konusu : '.$request->top.'<br>
                                 Mesaj : '.$request->mesaj.' <br>
                                 Mesaj Gonderilen Tarix : '.now().'','text/html'
         );
               $message->subject($request->name. ' iletisimden mesaj gonderdi');
         });
         //$contact = new Contact;
         //$contact->name=$request->adsoyad;
         //$contact->email=$request->email;
         //$contact->message=$request->mesaj;
         //$contact->secim=$request->top;
         
         //$contact->save();

         return redirect()->route('contact')->with('success','Mesajiniz ugurlu sekilde gonderildi');
   }
}
