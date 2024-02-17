<section class="product_section layout_padding">
   
   <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Sản phẩm thuộc <span>{{ $categoriesName }}</span>
          </h2>
          <br> <br>
         
       </div>
      
       @if (session()->has('message'))
       <div class="alert alert-success">
           <button class="close" data-dismiss="alert" aria-hidden="true">
               x
           </button>
           {{ session()->get('message') }}
       </div>
   @endif
       <div class="row">
         @forelse ($product as $products)
         <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="box">
               <div class="option_container">
                  <div class="options">
                     <a href="{{ url('product_details',$products->id) }}" class="option1">
                     Chi tiết sản phẩm
                     </a>
                     <form action="{{ url('add_cart',$products->id) }}" method="POST">
                        @csrf
                        <div class="row">
                           <div class="col-md-4">
                           <input type="number" name="quantity" value="1" min="1">
                           </div>
                           <div class="col-md-4">
                           <input type="submit" value="Thêm vào giỏ hàng">
                           </div>

                        </div>
                     </form>
                  </div>
               </div>
               <div class="img-box">
                <img src="{{ asset('product/' . urlencode($products->image)) }}" alt="">

               </div>
               <div class="detail-box">
                  <h5>
                     {{ $products->title }}
                  </h5>
                  @if ($products->discount_price!=null && $products->discount_price != 0)
                  <h6 class="text-danger">
                     Giảm còn $ <br>
                     {{$products->discount_price}}
                  </h6>
                  <h6 style="text-decoration: line-through" class="text-primary">
                     Giá <br>
                     ${{ $products->price }}
                  </h6>


                  @else
                  <h6 class="text-primary">
                     Giá <br>
                     ${{ $products->price }}
                  </h6>
                  @endif
                  
               </div>
            </div>
         </div>
         @empty
         <tr>
             <td colspan="17">Không tìm thấy dữ liệu</td>
         </tr>
     @endforelse
         
      </div>
      <span style="padding-top: 20px">

         {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
      </span>
 </section>