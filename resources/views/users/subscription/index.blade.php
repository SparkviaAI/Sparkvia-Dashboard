@extends('layouts.users.app')
@section('content')
<section class="dasboard-all pages pt-4 pb-4 height100vh">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-top">
                    <h1 class="content-hed">Purchase Spark Credits</h1>
                    <!-- <p class="content-pra">Subscribe to get spark coins and keep creating</p> -->
                    <!-- <p class="content-pra">Purchase Credits</p> -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="chat-section">
                    <div class="d-flex justify-content-between chtSecCls">
                        <div>
                            <h4 class="shapeHCls">Total Spark Credits</h4>
                        </div>
                        <div class="option-item nSpCls" style="margin-top: 10px;">
                            <a class="btn btn-secondary aSpcCls lightColorBtn" href="#" role="button" style="display:flex;background: gainsboro;color: black;">
                                <img src="{{ asset('landing-images/Logo Black FC.png') }}" width="70px" height="20px">
                                <span style="align-self: center;margin-left: 7px;">
                                    {{
                                        number_format($getUserWallet->balance_in_wallet, 0)
                                    }}
                                </span>
                            </a>
                            <a class="btn btn-success aSpcCls greenColorBtn" href="javascript:void(0);" onclick="openModal1()">Purchase Spark Credits</a>
                        </div>
                    </div>

                    <hr class="lineCls">

                    <div class="d-flex justify-content-between spWrCls" style="flex-wrap: wrap;">
                        <div>
                            <p class="shapeHCls" style="font-weight:700 !important;">Content Usage</p>
                            <p class="tool-hed2" style="color:black;font-weight:unset;">Total words generated for content</p>
                        </div>
                        <div>
                            <a class="btn btn-success aSpcCls" href="#" role="button" style="background: gainsboro;color: black;">{{ $getUserDetails->text_word_count }}<br>
                                <span>
                                    Words generated
                                </span>
                            </a>
                        </div>
                        <div class="vertLine"></div>
                        <div>
                            <p class="shapeHCls" style="font-weight:700 !important;">Image Usage</p>
                            <p class="tool-hed2" style="color:black;font-weight:unset;">Total words generated for image</p>
                        </div>
                        <div>
                            <a class="btn btn-success aSpcCls" href="#" role="button" style="background: gainsboro;color: black;">{{ $getUserDetails->image_word_count }}<br>
                                <span>
                                    Words generated
                                </span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="chat-section">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>Purchase History</h4>
                        </div>
                    </div>

                    <hr class="lineCls">
                    
                    <div class="disOverCls">
                    
                    <div class="card-body p-0">
                        <table class="table table-striped table-valign-middle all-table">
                            <thead>
                            <tr>
                                <th>Number of Spark credits purchased</th>
                                <th>From Address</th>
                                <th>Amount(in XRP)</th>
                                <th>Transaction</th>
                                <th>Status</th>
                                <th>Date & Time</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(!empty($getDepsoitTransactions))
                                    @foreach($getDepsoitTransactions as $transaction)
                                        <tr>
                                            <td> {{ $transaction->converted_xrp_tokens }} Spark Credits</td>
                                            <td>{{ $transaction->from_address }}</td>
                                            <td>{{ number_format($transaction->amount, 4) }} XRP</td>
                                            <td style="word-break: break-all;">{{ $transaction->transaction_id }}</td>
                                            <td>
                                                @if(($transaction->is_admin_receive) == 1)
                                                    Complete
                                                @else
                                                    Processing
                                                @endif
                                            </td>
                                            <td>{{ ($transaction->created_at)->format("Y-M-d H:i:s") }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <!-- <tr>
                                    <td>20</td>
                                    <td>2 $XRP</td>
                                    <td>19-04-2024, 01:30am</td>
                                    <td>9697687786271893987</td>
                                </tr>
                                <tr>
                                    <td>80</td>
                                    <td>8 $XRP</td>
                                    <td>10-03-2024, 06:00am</td>
                                    <td>1431325454313893987</td>
                                </tr>
                                <tr>
                                    <td>90</td>
                                    <td>9 $XRP</td>
                                    <td>31-05-2024, 04:30pm</td>
                                    <td>58726359186271893987</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Modals Start -->

    <!-- Modal 1: Purchase Coins -->
    <div class="modal fade modal-first" id="modalPurchaseCoins" tabindex="-1" aria-hidden="true">
    <!-- data-bs-backdrop="static" data-bs-keyboard="false" -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!--{{-- <button type="button" data-bs-dismiss="modal">
                    <img src="{{ asset('users-images/icons8-cancel-512.png') }}" class="close-btton-icon" />
                </button> --}} -->
                <!-- <div class="">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="newBtnClsCls"></button>
                </div> -->
                <div class="modal-body text-center">
                    <!-- <img src="{{ asset('users-images/coin.png') }}" class="coin-icon mb-3" /> -->
                    <div class="row">
                        <div class="d-flex justify-content-center mt-3">
                            <div class="col-md-9">
                                <h5 class="modal-title purch-coin">Purchase Spark Credits</h5>
                                <p class="modal-title-text">To purchase Spark credits, click on the generate address below and send the equivalent you want in XRP</p>
                                <div class="mb-3">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="col-md-4 mb-3 mt-3">
                                <h6 class="modal-title conversion-rate">CONVERSION RATE</h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="col-md-9 mb-6">
                                <!-- <h2 class="modal-title token-text"><span><img src="{{ asset('users-images/coin.png') }}" class="convert-icon1" /></span>1 XRP = <img src="{{ asset('users-images/coin.png') }}" class="convert-icon2" /></span>10 Tokens</h2> -->
                                <h2 class="modal-title token-text">
                                    <span>
                                        <!-- <img src="{{ asset('users-images/coin.png') }}" class="convert-icon1" /></span> -->
                                        {{ number_format(@$getConvertData->xrp_amount,0) ?? 1 }} XRP = 
                                        <!-- <img src="{{ asset('users-images/coin.png') }}" class="convert-icon2" /> -->
                                        {{ @$getConvertData->sparks_amount ?? 5 }} Spark Credits
                                    </span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="generateAddressBtn">Generate Address</button>
                    <div id="errorMessage" class="text-danger mt-2" style="display: none;">Error while generating address. Please try again.</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2: QR Code -->
    <div class="modal fade" id="modalQRCode" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- <img src="{{ asset('users-images/icons8-cancel-512.png') }}" class="close-btton-icon" /> -->
                <div class="modal-body text-center">
                    <h5 class="modal-title">Purchase Spark Credits</h5>
                    <p class="text-muted">Scan QR code or copy address to buy Spark Credits</p>
                    <div class="d-flex justify-content-center" id="qrCodeContainer">
                        <!-- QR code will be inserted here -->
                    </div>
                    <!-- <p class="text-muted">Scan this QR to pay</p> -->
                    <!-- <p><strong>Address:</strong> <span id="paymentAddress"></span></p> -->
                    <!-- <p><span id="paymentAddress"></span></p> -->
                    <div id="qrInfoContainer"></div>
                    <button type="button" class="btn btn-dark mt-2" onclick="openModal3()">Complete Transaction</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3: Processing -->
    <!-- <div class="modal fade" id="modalProcessing" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{ asset('users-images/success.gif') }}" width="60" class="mb-3" />
                    <h5 class="modal-title">Purchase Processing</h5>
                    <p>Your transaction is being verified...</p>
                    <button type="button" class="btn btn-success mt-2" onclick="closeModal3()">Go Back</button>
                </div>
            </div>
        </div>
    </div> -->
    <div class="modal fade" id="modalProcessing" tabindex="-1" aria-hidden="true" data-bs-keyboard="false"  data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- <img src="{{ asset('users-images/icons8-cancel-512.png') }}" class="close-btton-icon" /> -->
                <div class="modal-body text-center">
                    <!-- <img src="{{ asset('users-images/coin.png') }}" class="coin-icon mb-3" /> -->
                    <div class="row">
                        <div class="d-flex justify-content-center mt-3">
                            <div class="col-md-9">
                                <h5 class="modal-title purch-coin">Purchase Processing</h5>
                                <p class="modal-title-text">Once your transaction is confirmed, your account will be credited with your Spark credits.</p>
                                <div class="mb-3">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="col-md-9 mb-6">
                                <h2 class="modal-title token-text">
                                    <span style="font-size: 16.15px !important;">
                                        Your transaction should take 1-3 minutes
                                    </span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" onclick="closeModal3()">Go Back</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modals End -->
</section>
    
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>

    function closeModOne(){
        const moda = new bootstrap.Modal(document.getElementById('modalPurchaseCoins'));
        moda.hide();
    };

    function openModal1() {
        const modal1 = new bootstrap.Modal(document.getElementById('modalPurchaseCoins'));
        modal1.show();
    }

    function openModal2() {
        const m1 = bootstrap.Modal.getInstance(document.getElementById('modalPurchaseCoins'));
        if (m1) m1.hide();

        const modal2 = new bootstrap.Modal(document.getElementById('modalQRCode'));
        modal2.show();
    }

    function openModal3() {
        const m2 = bootstrap.Modal.getInstance(document.getElementById('modalQRCode'));
        if (m2) m2.hide();

        const modal3 = new bootstrap.Modal(document.getElementById('modalProcessing'));
        modal3.show();
    }

    function closeModal3() {
        // Close the modal
        // const modal3 = bootstrap.Modal.getInstance(document.getElementById('modalProcessing'));
        // if (modal3) modal3.hide();
        // Hard refresh the page
        location.reload(true);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // document.getElementById('generateAddressBtn').addEventListener('click', function() {
        //     // Show loading state
        //     const btn = this;
        //     btn.disabled = true;
        //     btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generating...';
            
        //     // Hide any previous error message
        //     document.getElementById('errorMessage').style.display = 'none';
            
        //     // Make API call
        //     fetch('{{ route("subscription.generate.address") }}', {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}',
        //             'Accept': 'application/json'
        //         },
        //         body: '',
        //     })
        //     .then(response => {
        //         if (!response.ok) {
        //             throw new Error('Network response was not ok');
        //         }
        //         return response.json();
        //     })
        //     .then(data => {
        //         // console.log("data");
        //         // console.log(data);
        //         if (data.success) {
        //             // Set the payment address
        //             document.getElementById('paymentAddress').textContent = data.address;
                    
        //             // Generate QR code (assuming the API returns a QR code image URL)
        //             // If you're generating QR code on the client side, you can use a library like qrcode.js
        //             const qrContainer = document.getElementById('qrCodeContainer');
        //             qrContainer.innerHTML = '';
                    
        //             var finalAddress = data.address;

        //             // console.log("finalAddress");
        //             // console.log(finalAddress);

        //             if (finalAddress) {
        //                 // Generate QR Code
        //                 new QRCode(document.getElementById("qrCodeContainer"), {
        //                     text: finalAddress,
        //                     width: 200,
        //                     height: 200,
        //                     colorDark: "#000000",
        //                     colorLight: "#ffffff",
        //                     correctLevel: QRCode.CorrectLevel.H
        //                 });

        //                 // Add styling to the generated img element
        //                 setTimeout(() => {
        //                     const qrImg = qrContainer.querySelector('img');
        //                     if (qrImg) {
        //                         qrImg.style.padding = "10px";
        //                         qrImg.style.border = "solid #49DF28 3px";
        //                         qrImg.style.borderRadius = "5px";
        //                         qrImg.style.backgroundColor = "#ffffff"; // Add white background
        //                     }
        //                 }, 100); // Small delay to ensure the img is created
        //             } 

        //             // Open modal 2
        //             openModal2();
        //         } else {
        //             throw new Error(data.message || 'Error generating address');
        //         }
        //     })
        //     .catch(error => {
        //         console.error('Error:', error);
        //         document.getElementById('errorMessage').style.display = 'block';
        //     })
        //     .finally(() => {
        //         btn.disabled = false;
        //         btn.innerHTML = 'Generate Address';
        //     });
        // });

        document.getElementById('generateAddressBtn').addEventListener('click', function() {
            const btn = this;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generating...';
            
            document.getElementById('errorMessage').style.display = 'none';
            
            fetch('{{ route("subscription.generate.address") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: '',
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Display address and tag
                    // document.getElementById('paymentAddress').innerHTML = `
                    //     <strong>Address:</strong> ${data.address}<br>
                    //     <strong>Destination Tag:</strong> ${data.wallet_key}
                    // `;
                    
                    // // Generate QR code with payment URI
                    // const qrContainer = document.getElementById('qrCodeContainer');
                    // qrContainer.innerHTML = '';


                    // Replace the QR code generation part with this:
                    const qrContainer = document.getElementById('qrCodeContainer');
                    const qrInfoContainer = document.getElementById('qrInfoContainer'); // Add this container in your HTML

                    // Clear previous content
                    qrContainer.innerHTML = '';
                    if (qrInfoContainer) {
                        qrInfoContainer.innerHTML = '';
                    } else {
                        // Create info container if it doesn't exist
                        const newInfoContainer = document.createElement('div');
                        newInfoContainer.id = 'qrInfoContainer';
                        qrContainer.after(newInfoContainer);
                    }
                    
                    new QRCode(qrContainer, {
                        text: data.xrp_uri,
                        width: 200,
                        height: 200,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });

                    // Add address and tag info to the new container
                    document.getElementById('qrInfoContainer').innerHTML = `
                        <div class="address-info mt-3">
                            <p><strong>Address:</strong> ${data.address}</p>
                            <p><strong>Destination Tag:</strong> ${data.wallet_key}</p>
                        </div>
                        <div class="copy-buttons mt-2">
                            <button class="btn btn-sm btn-outline-secondary copy-btn" data-text="${data.address}">
                                <i class="fas fa-copy"></i> Copy Address
                            </button>
                            <button class="btn btn-sm btn-outline-secondary copy-btn" data-text="${data.wallet_key}">
                                <i class="fas fa-copy"></i> Copy Tag
                            </button>
                        </div>
                        <p class="text-muted small mt-2">Important: You must include the destination tag!</p>
                    `;
                    
                    // // Add copy buttons
                    // qrContainer.insertAdjacentHTML('afterend', `
                    //     <div class="mt-3">
                    //         <button class="btn btn-sm btn-outline-secondary copy-btn" data-text="${data.address}">
                    //             <i class="fas fa-copy"></i> Copy Address
                    //         </button>
                    //         <button class="btn btn-sm btn-outline-secondary copy-btn" data-text="${data.wallet_key}">
                    //             <i class="fas fa-copy"></i> Copy Tag
                    //         </button>
                    //     </div>
                    //     <p class="text-muted small mt-2">Important: You must include the destination tag!</p>
                    // `);
                    
                    // Add copy functionality
                    document.querySelectorAll('.copy-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const text = this.getAttribute('data-text');
                            navigator.clipboard.writeText(text).then(() => {
                                const originalText = this.innerHTML;
                                this.innerHTML = '<i class="fas fa-check"></i> Copied!';
                                setTimeout(() => {
                                    this.innerHTML = originalText;
                                }, 2000);
                            });
                        });
                    });
                    
                    openModal2();
                } else {
                    throw new Error(data.message || 'Error generating address');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('errorMessage').textContent = error.message;
                document.getElementById('errorMessage').style.display = 'block';
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = 'Generate Address';
            });
        });
    });
</script>
<style>
    /* Add this to your CSS file */
    #qrCodeContainer img {
        padding: 10px;
        border: solid #49DF28 3px;
        border-radius: 5px;
        background-color: #ffffff;
    }

    .modal.fade.modal-first .modal-content {
        width: 100%;
        max-width: 501px;
        border: 1px solid;
        border-image-source: linear-gradient(91.9deg, rgba(237, 252, 234, 0.2) 1.89%, rgba(112, 112, 112, 0.2) 99.49%);
        border-radius: 20px !important;
    }


    .modal.fade.modal-first img.coin-icon.mb-3 {
        width: 100%;
        max-width: 97.23px;
        margin: 50px 0 0 0;
    }

    .modal.fade.modal-first h5.modal-title.purch-coin{
        font-family: Albert Sans;
        font-weight: 600;
        font-style: SemiBold;
        font-size: 32px;
        leading-trim: CAP_HEIGHT;
        line-height: 130%;
        letter-spacing: 0%;
        text-align: center;
        color: #0B0B0B;
    }

    .modal.fade.modal-first modal-title-text {
        font-family: Albert Sans;
        font-weight: 300;
        font-style: Light;
        font-size: 14px;
        leading-trim: CAP_HEIGHT;
        line-height: 130%;
        letter-spacing: 0%;
        text-align: center;
        color: #0B0B0B;
    }

    .modal.fade.modal-first .conversion-rate {
        font-family: Albert Sans;
        font-weight: 700;
        font-style: Bold;
        font-size: 10px;
        leading-trim: CAP_HEIGHT;
        line-height: 130%;
        letter-spacing: 30%;
        text-align: center;
        text-transform: uppercase;
        color: #0B0B0B99;
    }

    img.convert-icon1 {
    width: 100%;
    max-width: 32px;
    margin: 0 3px 0 0px;
}

img.convert-icon2 {
    width: 100%;
    max-width: 32px;
    margin: 0 0 0 3px;
}


h2.modal-title.token-text {
    font-family: Albert Sans;
    font-weight: 600;
    font-style: SemiBold;
    /* font-size: 30.15px; */
    font-size: 22.15px;
    leading-trim: CAP_HEIGHT;
    line-height: 130%;
    letter-spacing: 0%;
    text-align: center;
    text-transform: capitalize;
    color: #0B0B0B;
    margin: 0 0 30px 0;
}

h2.modal-title.token-text {
    font-family: Albert Sans;
    font-weight: 600;
    font-style: SemiBold;
    /* font-size: 30.15px; */
    font-size: 22.15px;
    leading-trim: CAP_HEIGHT;
    line-height: 130%;
    letter-spacing: 0%;
    text-align: center;
    text-transform: capitalize;
    color: #0B0B0B;
    margin: 0 0 30px 0;
    background: #F3F4F6;
    padding: 10px;
    border-radius: 12.97px;
}

button#generateAddressBtn {
    background: #49DF28;
    border: none;
    width: 100%;
    max-width: 398px;
    border-radius: 5px;
    height: 49px;
    font-family: Albert Sans;
    font-weight: 600;
    font-style: SemiBold;
    font-size: 16px;
    leading-trim: CAP_HEIGHT;
    line-height: 130%;
    letter-spacing: 0%;
    text-align: center;
    text-transform: capitalize;
    color: #0B0B0B;
}

img.close-btton-icon {
    width: 100%;
    max-width: 24px;
    position: absolute;
    right: 30px;
    top: 25px;
}

/* Add to your existing styles */
.copy-btn {
    margin: 0 5px;
}

#paymentAddress {
    word-break: break-all;
    background: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    display: inline-block;
    margin-top: 10px;
}

#paymentAddress strong {
    color: #495057;
}

#newBtnClsCls{
    padding: 1%;
    right: 30px;
    top: 30px;
    font-size: smaller;
    border: solid black;
    border-radius: inherit;
}
.disOverCls{
    overflow: auto;
}

@media (max-width:991px) {
    .chat-section {
        margin: 50px 0;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
    }

    .chtSecCls {
        flex-wrap: wrap;
    }
    a.btn.btn-secondary.aSpcCls.lightColorBtn{
        display: flex;
        background: gainsboro;
        color: black;
        height: 64px;
        justify-content: center;
        align-items: center;
    }
    .greenColorBtn {
        background-color: #49DF28 !important;
        width: 100%;
        font-size: 14px;
        padding-top: 8px;
        padding-bottom: 8px;
        height: 60px;
    }
    .spWrCls{
        gap: 15px !important;
    }
    .vertLine {
        display: none;
    }
}



</style>
@endsection('content')