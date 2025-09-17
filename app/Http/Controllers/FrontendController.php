<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\User;
use Auth;
use Session;
use Newsletter;
use DB;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Certificate;
class FrontendController extends Controller
{
   
    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }

    public function home(){
        $posts=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $products=Product::orderBy('id','DESC')->limit(8)->get();
        $category=Category::orderBy('sort_order','ASC')->orderBy('title','ASC')->get();
        $projectCategories=\App\Models\ProjectCategory::orderBy('name','ASC')->get();
        $settings=\DB::table('settings')->first();
        // return $category;
        return view('frontend.index')
                ->with('posts',$posts)
                ->with('product_lists',$products)
                ->with('category_lists',$category)
                ->with('project_categories',$projectCategories)
                ->with('settings',$settings);
    }   

    public function aboutUs(){
        return view('frontend.pages.about-us');
    }

    public function contact(){
        $settings = \DB::table('settings')->first();
        return view('frontend.pages.contact', compact('settings'));
    }

    public function productDetail($slug){
        $product_detail= Product::getProductBySlug($slug);
        // dd($product_detail);
        return view('frontend.pages.product_detail')->with('product_detail',$product_detail);
    }

    public function productGrids(){
        $products=Product::query();
        $categories = Category::orderBy('sort_order','ASC')->orderBy('title','ASC')->get();
        
        if(!empty($_GET['category'])){
            $cat_ids = explode(',', $_GET['category']);
            $products->whereIn('category_id', $cat_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->orderBy('title','ASC');
            }
        }

        $recent_products=Product::orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->paginate($_GET['show']);
        }
        else{
            $products=$products->paginate(9);
        }
        // Sort by name, category

        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products)->with('categories', $categories);
    }
    public function productLists(){
        $products=Product::query();
        $categories = Category::orderBy('sort_order','ASC')->orderBy('title','ASC')->get();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids)->paginate;
            // return $products;
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->orderBy('title','ASC');
            }
        }

        $recent_products=Product::orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->paginate($_GET['show']);
        }
        else{
            $products=$products->paginate(6);
        }
        // Sort by name, category

      
        return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products)->with('categories', $categories);
    }
    public function productFilter(Request $request){
            $data= $request->all();
            // return $data;
            $showURL="";
            if(!empty($data['show'])){
                $showURL .='&show='.$data['show'];
            }

            $sortByURL='';
            if(!empty($data['sortBy'])){
                $sortByURL .='&sortBy='.$data['sortBy'];
            }

            $catURL="";
            if(!empty($data['category'])){
                foreach($data['category'] as $category){
                    if(empty($catURL)){
                        $catURL .='&category='.$category;
                    }
                    else{
                        $catURL .=','.$category;
                    }
                }
            }

            if(request()->is('SOTUMA.loc/product-grids')){
                return redirect()->route('product-grids',$catURL.$showURL.$sortByURL);
            }
            else{
                return redirect()->route('product-lists',$catURL.$showURL.$sortByURL);
            }
    }
    public function productSearch(Request $request){
        $recent_products=Product::orderBy('id','DESC')->limit(3)->get();
        $products=Product::orwhere('title','like','%'.$request->search.'%')
                    ->orwhere('slug','like','%'.$request->search.'%')
                    ->orwhere('description','like','%'.$request->search.'%')
                    ->orderBy('id','DESC')
                    ->paginate('9');
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }

    public function productCat(Request $request){
        $products=Category::getProductByCat($request->slug);
        // return $request->slug;
        $recent_products=Product::orderBy('id','DESC')->limit(3)->get();

        if(request()->is('SOTUMA.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }
    public function productSubCat(Request $request){
        $products=Category::getProductBySubCat($request->sub_slug);
        // return $products;
        $recent_products=Product::orderBy('id','DESC')->limit(3)->get();

        if(request()->is('SOTUMA.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }

    }

    public function blog(Request $request){
        // Show ALL posts on one page - no pagination
        $perPage = 1000;
        
        // Build the query with proper relationships
        $posts = Post::with(['cat_info', 'author_info', 'images'])
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->paginate($perPage);
            
        // Get recent posts for sidebar
        $recent_posts = Post::with(['cat_info', 'author_info', 'images'])
            ->where('status', 'active')
            ->when($posts->first(), function($query, $firstPost) {
                return $query->where('id', '!=', $firstPost->id);
            })
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
            
        return view('frontend.pages.blog')
            ->with('posts', $posts)
            ->with('recent_posts', $recent_posts);
    }

    public function blogDetail($slug){
        $post = Post::getPostBySlug($slug);
        
        if(!$post){
            request()->session()->flash('error','Article non trouvé');
            return redirect()->route('media');
        }
        
        // Increment view count
        $post->incrementViews();
        
        // Get related posts from same category
        $relatedPosts = Post::with(['cat_info', 'author_info', 'images'])
            ->where('status', 'active')
            ->where('id', '!=', $post->id)
            ->where('post_cat_id', $post->post_cat_id)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
            
        // Get recent posts for sidebar
        $recent_posts = Post::with(['cat_info', 'author_info', 'images'])
            ->where('status', 'active')
            ->where('id', '!=', $post->id)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
            
        // Get popular posts for sidebar
        $popular_posts = Post::with(['cat_info', 'author_info', 'images'])
            ->where('status', 'active')
            ->where('id', '!=', $post->id)
            ->orderBy('views', 'DESC')
            ->limit(5)
            ->get();
            
        return view('frontend.pages.blog-detail')
            ->with('post', $post)
            ->with('recent_posts', $recent_posts)
            ->with('relatedPosts', $relatedPosts)
            ->with('popular_posts', $popular_posts);
    }

    public function blogSearch(Request $request){
        $search = $request->get('search', '');
        $perPage = 1000; // Show ALL posts on one page - no pagination
        
        // Build search query with proper where clause
        $posts = Post::with(['cat_info', 'author_info', 'images'])
            ->where('status', 'active')
            ->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('quote', 'like', '%' . $search . '%')
                      ->orWhere('summary', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('tags', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'DESC')
            ->paginate($perPage);
            
        // Get recent posts for sidebar
        $recent_posts = Post::with(['cat_info', 'author_info', 'images'])
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
            
        return view('frontend.pages.blog')
            ->with('posts', $posts)
            ->with('recent_posts', $recent_posts)
            ->with('search', $search);
    }

    public function blogFilter(Request $request){
        $data=$request->all();
        // return $data;
        $catURL="";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .='&category='.$category;
                }
                else{
                    $catURL .=','.$category;
                }
            }
        }

        $tagURL="";
        if(!empty($data['tag'])){
            foreach($data['tag'] as $tag){
                if(empty($tagURL)){
                    $tagURL .='&tag='.$tag;
                }
                else{
                    $tagURL .=','.$tag;
                }
            }
        }
        // return $tagURL;
            // return $catURL;
        return redirect()->route('blog',$catURL.$tagURL);
    }

    public function blogByCategory(Request $request){
        $slug = $request->slug;
        $perPage = 1000; // Show ALL posts on one page - no pagination
        
        // Get category
        $category = PostCategory::where('slug', $slug)->where('status', 'active')->first();
        
        if (!$category) {
            request()->session()->flash('error', 'Catégorie non trouvée');
            return redirect()->route('media');
        }
        
        // Get posts for this category with pagination
        $posts = Post::with(['cat_info', 'author_info', 'images'])
            ->where('status', 'active')
            ->where('post_cat_id', $category->id)
            ->orderBy('id', 'DESC')
            ->paginate($perPage);
            
        // Get recent posts for sidebar
        $recent_posts = Post::with(['cat_info', 'author_info', 'images'])
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
            
        return view('frontend.pages.blog')
            ->with('posts', $posts)
            ->with('recent_posts', $recent_posts)
            ->with('category', $category);
    }

    public function blogByTag(Request $request){
        $tag = $request->slug;
        $perPage = 1000; // Show ALL posts on one page - no pagination
        
        // Get posts with this tag
        $posts = Post::with(['cat_info', 'author_info', 'images'])
            ->where('status', 'active')
            ->where('tags', 'like', '%' . $tag . '%')
            ->orderBy('id', 'DESC')
            ->paginate($perPage);
            
        // Get recent posts for sidebar
        $recent_posts = Post::with(['cat_info', 'author_info', 'images'])
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
            
        return view('frontend.pages.blog')
            ->with('posts', $posts)
            ->with('recent_posts', $recent_posts)
            ->with('tag', $tag);
    }

    public function certificates()
    {
        $certificates = Certificate::latest()->get();
        return view('frontend.pages.certificates', compact('certificates'));
    }

    public function nosProduits(Request $request) {
        $categories = \App\Models\Category::with(['products' => function($q) {
            $q->select('id', 'title', 'image', 'description', 'category_id');
        }])->get();

        // Build products collection for the grid
        $productsQuery = \App\Models\Product::query();
        if ($request->has('category')) {
            $category = \App\Models\Category::where('slug', $request->category)->first();
            if ($category) {
                $productsQuery->where('category_id', $category->id);
            }
        }
        $products = $productsQuery->orderBy('id', 'desc')->get();

        return view('frontend.pages.products', compact('categories', 'products'));
    }

    // Login
    public function login(){
        return view('frontend.pages.login');
    }
    public function loginSubmit(Request $request){
        $data= $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active'])){
            Session::put('user',$data['email']);
            request()->session()->flash('success','Successfully login');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Invalid email and password pleas try again!');
            return redirect()->back();
        }
    }

    public function logout(){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logout successfully');
        return back();
    }

    public function register(){
        return view('frontend.pages.register');
    }
    public function registerSubmit(Request $request){
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'string|required|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $data=$request->all();
        // dd($data);
        $check=$this->create($data);
        Session::put('user',$data['email']);
        if($check){
            request()->session()->flash('success','Successfully registered');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Please try again!');
            return back();
        }
    }
    public function create(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>'active'
            ]);
    }
    // Reset password
    public function showResetForm(){
        return view('auth.passwords.old-reset');
    }

    public function subscribe(Request $request){
        if(! Newsletter::isSubscribed($request->email)){
                Newsletter::subscribePending($request->email);
                if(Newsletter::lastActionSucceeded()){
                    request()->session()->flash('success','Subscribed! Please check your email');
                    return redirect()->route('home');
                }
                else{
                    Newsletter::getLastError();
                    return back()->with('error','Something went wrong! please try again');
                }
            }
            else{
                request()->session()->flash('error','Already Subscribed');
                return back();
            }
    }
    
}
