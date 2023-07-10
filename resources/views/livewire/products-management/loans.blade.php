


<div class="w-full">
    <!-- message container -->





    <div class="accordion">
        <!-- Accordion Item 1 -->
        <div class="accordion-item">
          <input type="checkbox" id="accordion-item-1" class="accordion-toggle">
          <label for="accordion-item-1" class="accordion-title w-full">CREATE NEW LOAN PRODUCT</label>
          <div class="accordion-content">
            <!-- Content for Accordion Item 1 -->

            <div class="panel">
                <livewire:products-management.new-loan-product :product_id="104"/>
            </div>



          </div>
        </div>

        @foreach(App\Models\Loan_sub_products::get() as $subProduct)


            <div class="accordion-item">
              <input type="checkbox" id="accordion-item-3" class="accordion-toggle">
              <label for="accordion-item-3" class="accordion-title">{{$subProduct->sub_product_name}}</label>
              <div class="accordion-content">
                <!-- Content for Accordion Item 3 -->

                <div class="panel">
                    <livewire:products-management.loan-product-data-loader :sub_id="$subProduct->id"/>
                </div>
              </div>
            </div>




            @endforeach




      </div>








