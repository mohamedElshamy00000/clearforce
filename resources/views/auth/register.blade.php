@extends('layouts.auth')

@section('content')

<!-- Register -->
<div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
    <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <img src="{{ asset('backend/assets/img/clear forces-10.png') }}" width="100%" alt="">
                </span>
            </a>
            </div>
            <!-- /Logo -->
            <h3 class="mb-1 fw-bold">{{ __('general.Create_an_account') }} 🚀</h3>
            <p class="mb-4"></p>

            <form id="formAuthentication" class="mb-3"  method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row pb-2">
                <div class="col-md mb-md-0 mb-2">
                  <div class="form-check custom-option custom-option-icon checked">
                    <label class="form-check-label custom-option-content" for="Importer">
                      <span class="custom-option-body">
                        <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M22.75 33.75V6.25C22.75 5.91848 22.6183 5.60054 22.3839 5.36612C22.1495 5.1317 21.8315 5 21.5 5H6.5C6.16848 5 5.85054 5.1317 5.61612 5.36612C5.3817 5.60054 5.25 5.91848 5.25 6.25V33.75" fill="currentColor" fill-opacity="0.2"></path>
                          <path d="M2.75 32.75C2.19772 32.75 1.75 33.1977 1.75 33.75C1.75 34.3023 2.19772 34.75 2.75 34.75V32.75ZM37.75 34.75C38.3023 34.75 38.75 34.3023 38.75 33.75C38.75 33.1977 38.3023 32.75 37.75 32.75V34.75ZM21.75 33.75C21.75 34.3023 22.1977 34.75 22.75 34.75C23.3023 34.75 23.75 34.3023 23.75 33.75H21.75ZM21.5 5V4V5ZM5.25 6.25H4.25H5.25ZM4.25 33.75C4.25 34.3023 4.69772 34.75 5.25 34.75C5.80228 34.75 6.25 34.3023 6.25 33.75H4.25ZM34.25 33.75C34.25 34.3023 34.6977 34.75 35.25 34.75C35.8023 34.75 36.25 34.3023 36.25 33.75H34.25ZM22.75 14C22.1977 14 21.75 14.4477 21.75 15C21.75 15.5523 22.1977 16 22.75 16V14ZM10.25 10.25C9.69772 10.25 9.25 10.6977 9.25 11.25C9.25 11.8023 9.69772 12.25 10.25 12.25V10.25ZM15.25 12.25C15.8023 12.25 16.25 11.8023 16.25 11.25C16.25 10.6977 15.8023 10.25 15.25 10.25V12.25ZM12.75 20.25C12.1977 20.25 11.75 20.6977 11.75 21.25C11.75 21.8023 12.1977 22.25 12.75 22.25V20.25ZM17.75 22.25C18.3023 22.25 18.75 21.8023 18.75 21.25C18.75 20.6977 18.3023 20.25 17.75 20.25V22.25ZM10.25 26.5C9.69772 26.5 9.25 26.9477 9.25 27.5C9.25 28.0523 9.69772 28.5 10.25 28.5V26.5ZM15.25 28.5C15.8023 28.5 16.25 28.0523 16.25 27.5C16.25 26.9477 15.8023 26.5 15.25 26.5V28.5ZM27.75 26.5C27.1977 26.5 26.75 26.9477 26.75 27.5C26.75 28.0523 27.1977 28.5 27.75 28.5V26.5ZM30.25 28.5C30.8023 28.5 31.25 28.0523 31.25 27.5C31.25 26.9477 30.8023 26.5 30.25 26.5V28.5ZM27.75 20.25C27.1977 20.25 26.75 20.6977 26.75 21.25C26.75 21.8023 27.1977 22.25 27.75 22.25V20.25ZM30.25 22.25C30.8023 22.25 31.25 21.8023 31.25 21.25C31.25 20.6977 30.8023 20.25 30.25 20.25V22.25ZM2.75 34.75H37.75V32.75H2.75V34.75ZM23.75 33.75V6.25H21.75V33.75H23.75ZM23.75 6.25C23.75 5.65326 23.5129 5.08097 23.091 4.65901L21.6768 6.07322C21.7237 6.12011 21.75 6.18369 21.75 6.25H23.75ZM23.091 4.65901C22.669 4.23705 22.0967 4 21.5 4V6C21.5663 6 21.6299 6.02634 21.6768 6.07322L23.091 4.65901ZM21.5 4H6.5V6H21.5V4ZM6.5 4C5.90326 4 5.33097 4.23705 4.90901 4.65901L6.32322 6.07322C6.37011 6.02634 6.4337 6 6.5 6V4ZM4.90901 4.65901C4.48705 5.08097 4.25 5.65326 4.25 6.25H6.25C6.25 6.1837 6.27634 6.12011 6.32322 6.07322L4.90901 4.65901ZM4.25 6.25V33.75H6.25V6.25H4.25ZM36.25 33.75V16.25H34.25V33.75H36.25ZM36.25 16.25C36.25 15.6533 36.013 15.081 35.591 14.659L34.1768 16.0732C34.2237 16.1201 34.25 16.1837 34.25 16.25H36.25ZM35.591 14.659C35.169 14.2371 34.5967 14 34 14V16C34.0663 16 34.1299 16.0263 34.1768 16.0732L35.591 14.659ZM34 14H22.75V16H34V14ZM10.25 12.25H15.25V10.25H10.25V12.25ZM12.75 22.25H17.75V20.25H12.75V22.25ZM10.25 28.5H15.25V26.5H10.25V28.5ZM27.75 28.5H30.25V26.5H27.75V28.5ZM27.75 22.25H30.25V20.25H27.75V22.25Z" fill="currentColor"></path>
                        </svg>

                        <span class="custom-option-title">{{ __('general.Importer / exporter') }}</span>
                      </span>
                      <input name="type" class="form-check-input" type="radio" value="1" id="Importer" checked="">
                    </label>
                  </div>
                </div>
                <div class="col-md mb-md-0 mb-2">
                  <div class="form-check custom-option custom-option-icon">
                    <label class="form-check-label custom-option-content" for="broker">
                      <span class="custom-option-body">
                        <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M29 6.25H20.25L12.5781 16.25L20.25 35L37.75 16.25L29 6.25Z" fill="currentColor" fill-opacity="0.2"></path>
                          <path d="M11.5 6.25H29L37.75 16.25L20.25 35L2.75 16.25L11.5 6.25Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M21.0434 5.64131C20.8542 5.39462 20.5609 5.25 20.25 5.25C19.9391 5.25 19.6458 5.39462 19.4566 5.64131L12.0849 15.25H2.75C2.19772 15.25 1.75 15.6977 1.75 16.25C1.75 16.8023 2.19772 17.25 2.75 17.25H11.9068L19.3245 35.3787C19.4782 35.7545 19.844 36 20.25 36C20.656 36 21.0218 35.7545 21.1755 35.3787L28.5932 17.25H37.75C38.3023 17.25 38.75 16.8023 38.75 16.25C38.75 15.6977 38.3023 15.25 37.75 15.25H28.4151L21.0434 5.64131ZM25.8943 15.25L20.25 7.89287L14.6057 15.25H25.8943ZM14.0678 17.25L20.25 32.3593L26.4322 17.25H14.0678Z" fill="currentColor"></path>
                        </svg>
                        <span class="custom-option-title">{{ __('general.Im a customs broker') }} </span>
                      </span>
                      <input name="type" class="form-check-input" type="radio" value="2" id="broker">
                    </label>
                  </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">{{ __('general.Username') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="username" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your name" />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mb-3" id="showInClient">
                <div class="col-6">
                    <label for="company" class="form-label">{{ __('general.company') }}</label>
                    <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{ old('company') }}" required autofocus placeholder="company name" />
                    @error('company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="col-6">
                    <label for="industry" class="form-label">{{ __('general.industry') }}</label>
                    <input type="text" class="form-control @error('industry') is-invalid @enderror" id="industry" name="industry" value="{{ old('industry') }}" required autofocus placeholder="industry" />
                    @error('industry')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('general.E_mail') }}</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="phone" class="form-label">{{ __('general.Phone_Number') }}</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required autofocus placeholder="Enter your phone" />
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">{{ __('general.Country') }}</label>
                            
                <select id="country" name="country" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country') }}">
                    <option value="0" label="Select a country ... " selected="selected">Select a country ... </option>
                    <optgroup id="country-optgroup-Africa" label="Africa">
                        <option value="DZ" label="Algeria">Algeria</option>
                        <option value="AO" label="Angola">Angola</option>
                        <option value="BJ" label="Benin">Benin</option>
                        <option value="BW" label="Botswana">Botswana</option>
                        <option value="BF" label="Burkina Faso">Burkina Faso</option>
                        <option value="BI" label="Burundi">Burundi</option>
                        <option value="CM" label="Cameroon">Cameroon</option>
                        <option value="CV" label="Cape Verde">Cape Verde</option>
                        <option value="CF" label="Central African Republic">Central African Republic</option>
                        <option value="TD" label="Chad">Chad</option>
                        <option value="KM" label="Comoros">Comoros</option>
                        <option value="CG" label="Congo - Brazzaville">Congo - Brazzaville</option>
                        <option value="CD" label="Congo - Kinshasa">Congo - Kinshasa</option>
                        <option value="CI" label="Côte d’Ivoire">Côte d’Ivoire</option>
                        <option value="DJ" label="Djibouti">Djibouti</option>
                        <option value="EG" label="Egypt">Egypt</option>
                        <option value="GQ" label="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="ER" label="Eritrea">Eritrea</option>
                        <option value="ET" label="Ethiopia">Ethiopia</option>
                        <option value="GA" label="Gabon">Gabon</option>
                        <option value="GM" label="Gambia">Gambia</option>
                        <option value="GH" label="Ghana">Ghana</option>
                        <option value="GN" label="Guinea">Guinea</option>
                        <option value="GW" label="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="KE" label="Kenya">Kenya</option>
                        <option value="LS" label="Lesotho">Lesotho</option>
                        <option value="LR" label="Liberia">Liberia</option>
                        <option value="LY" label="Libya">Libya</option>
                        <option value="MG" label="Madagascar">Madagascar</option>
                        <option value="MW" label="Malawi">Malawi</option>
                        <option value="ML" label="Mali">Mali</option>
                        <option value="MR" label="Mauritania">Mauritania</option>
                        <option value="MU" label="Mauritius">Mauritius</option>
                        <option value="YT" label="Mayotte">Mayotte</option>
                        <option value="MA" label="Morocco">Morocco</option>
                        <option value="MZ" label="Mozambique">Mozambique</option>
                        <option value="NA" label="Namibia">Namibia</option>
                        <option value="NE" label="Niger">Niger</option>
                        <option value="NG" label="Nigeria">Nigeria</option>
                        <option value="RW" label="Rwanda">Rwanda</option>
                        <option value="RE" label="Réunion">Réunion</option>
                        <option value="SH" label="Saint Helena">Saint Helena</option>
                        <option value="SN" label="Senegal">Senegal</option>
                        <option value="SC" label="Seychelles">Seychelles</option>
                        <option value="SL" label="Sierra Leone">Sierra Leone</option>
                        <option value="SO" label="Somalia">Somalia</option>
                        <option value="ZA" label="South Africa">South Africa</option>
                        <option value="SD" label="Sudan">Sudan</option>
                        <option value="SZ" label="Swaziland">Swaziland</option>
                        <option value="ST" label="São Tomé and Príncipe">São Tomé and Príncipe</option>
                        <option value="TZ" label="Tanzania">Tanzania</option>
                        <option value="TG" label="Togo">Togo</option>
                        <option value="TN" label="Tunisia">Tunisia</option>
                        <option value="UG" label="Uganda">Uganda</option>
                        <option value="EH" label="Western Sahara">Western Sahara</option>
                        <option value="ZM" label="Zambia">Zambia</option>
                        <option value="ZW" label="Zimbabwe">Zimbabwe</option>
                    </optgroup>
                    <optgroup id="country-optgroup-Americas" label="Americas">
                        <option value="AI" label="Anguilla">Anguilla</option>
                        <option value="AG" label="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="AR" label="Argentina">Argentina</option>
                        <option value="AW" label="Aruba">Aruba</option>
                        <option value="BS" label="Bahamas">Bahamas</option>
                        <option value="BB" label="Barbados">Barbados</option>
                        <option value="BZ" label="Belize">Belize</option>
                        <option value="BM" label="Bermuda">Bermuda</option>
                        <option value="BO" label="Bolivia">Bolivia</option>
                        <option value="BR" label="Brazil">Brazil</option>
                        <option value="VG" label="British Virgin Islands">British Virgin Islands</option>
                        <option value="CA" label="Canada">Canada</option>
                        <option value="KY" label="Cayman Islands">Cayman Islands</option>
                        <option value="CL" label="Chile">Chile</option>
                        <option value="CO" label="Colombia">Colombia</option>
                        <option value="CR" label="Costa Rica">Costa Rica</option>
                        <option value="CU" label="Cuba">Cuba</option>
                        <option value="DM" label="Dominica">Dominica</option>
                        <option value="DO" label="Dominican Republic">Dominican Republic</option>
                        <option value="EC" label="Ecuador">Ecuador</option>
                        <option value="SV" label="El Salvador">El Salvador</option>
                        <option value="FK" label="Falkland Islands">Falkland Islands</option>
                        <option value="GF" label="French Guiana">French Guiana</option>
                        <option value="GL" label="Greenland">Greenland</option>
                        <option value="GD" label="Grenada">Grenada</option>
                        <option value="GP" label="Guadeloupe">Guadeloupe</option>
                        <option value="GT" label="Guatemala">Guatemala</option>
                        <option value="GY" label="Guyana">Guyana</option>
                        <option value="HT" label="Haiti">Haiti</option>
                        <option value="HN" label="Honduras">Honduras</option>
                        <option value="JM" label="Jamaica">Jamaica</option>
                        <option value="MQ" label="Martinique">Martinique</option>
                        <option value="MX" label="Mexico">Mexico</option>
                        <option value="MS" label="Montserrat">Montserrat</option>
                        <option value="AN" label="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="NI" label="Nicaragua">Nicaragua</option>
                        <option value="PA" label="Panama">Panama</option>
                        <option value="PY" label="Paraguay">Paraguay</option>
                        <option value="PE" label="Peru">Peru</option>
                        <option value="PR" label="Puerto Rico">Puerto Rico</option>
                        <option value="BL" label="Saint Barthélemy">Saint Barthélemy</option>
                        <option value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="LC" label="Saint Lucia">Saint Lucia</option>
                        <option value="MF" label="Saint Martin">Saint Martin</option>
                        <option value="PM" label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="VC" label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                        <option value="SR" label="Suriname">Suriname</option>
                        <option value="TT" label="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="TC" label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="VI" label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                        <option value="US" label="United States">United States</option>
                        <option value="UY" label="Uruguay">Uruguay</option>
                        <option value="VE" label="Venezuela">Venezuela</option>
                    </optgroup>
                    <optgroup id="country-optgroup-Asia" label="Asia">
                        <option value="AF" label="Afghanistan">Afghanistan</option>
                        <option value="AM" label="Armenia">Armenia</option>
                        <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                        <option value="BH" label="Bahrain">Bahrain</option>
                        <option value="BD" label="Bangladesh">Bangladesh</option>
                        <option value="BT" label="Bhutan">Bhutan</option>
                        <option value="BN" label="Brunei">Brunei</option>
                        <option value="KH" label="Cambodia">Cambodia</option>
                        <option value="CN" label="China">China</option>
                        <option value="GE" label="Georgia">Georgia</option>
                        <option value="HK" label="Hong Kong SAR China">Hong Kong SAR China</option>
                        <option value="IN" label="India">India</option>
                        <option value="ID" label="Indonesia">Indonesia</option>
                        <option value="IR" label="Iran">Iran</option>
                        <option value="IQ" label="Iraq">Iraq</option>
                        <option value="JP" label="Japan">Japan</option>
                        <option value="JO" label="Jordan">Jordan</option>
                        <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                        <option value="KW" label="Kuwait">Kuwait</option>
                        <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="LA" label="Laos">Laos</option>
                        <option value="LB" label="Lebanon">Lebanon</option>
                        <option value="MO" label="Macau SAR China">Macau SAR China</option>
                        <option value="MY" label="Malaysia">Malaysia</option>
                        <option value="MV" label="Maldives">Maldives</option>
                        <option value="MN" label="Mongolia">Mongolia</option>
                        <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                        <option value="NP" label="Nepal">Nepal</option>
                        <option value="NT" label="Neutral Zone">Neutral Zone</option>
                        <option value="KP" label="North Korea">North Korea</option>
                        <option value="OM" label="Oman">Oman</option>
                        <option value="PK" label="Pakistan">Pakistan</option>
                        <option value="PS" label="Palestinian Territories">Palestinian Territories</option>
                        <option value="YD" label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                        <option value="PH" label="Philippines">Philippines</option>
                        <option value="QA" label="Qatar">Qatar</option>
                        <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                        <option value="SG" label="Singapore">Singapore</option>
                        <option value="KR" label="South Korea">South Korea</option>
                        <option value="LK" label="Sri Lanka">Sri Lanka</option>
                        <option value="SY" label="Syria">Syria</option>
                        <option value="TW" label="Taiwan">Taiwan</option>
                        <option value="TJ" label="Tajikistan">Tajikistan</option>
                        <option value="TH" label="Thailand">Thailand</option>
                        <option value="TL" label="Timor-Leste">Timor-Leste</option>
                        <option value="TR" label="Turkey">Turkey</option>
                        <option value="TM" label="Turkmenistan">Turkmenistan</option>
                        <option value="AE" label="United Arab Emirates">United Arab Emirates</option>
                        <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                        <option value="VN" label="Vietnam">Vietnam</option>
                        <option value="YE" label="Yemen">Yemen</option>
                    </optgroup>
                    <optgroup id="country-optgroup-Europe" label="Europe">
                        <option value="AL" label="Albania">Albania</option>
                        <option value="AD" label="Andorra">Andorra</option>
                        <option value="AT" label="Austria">Austria</option>
                        <option value="BY" label="Belarus">Belarus</option>
                        <option value="BE" label="Belgium">Belgium</option>
                        <option value="BA" label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="BG" label="Bulgaria">Bulgaria</option>
                        <option value="HR" label="Croatia">Croatia</option>
                        <option value="CY" label="Cyprus">Cyprus</option>
                        <option value="CZ" label="Czech Republic">Czech Republic</option>
                        <option value="DK" label="Denmark">Denmark</option>
                        <option value="DD" label="East Germany">East Germany</option>
                        <option value="EE" label="Estonia">Estonia</option>
                        <option value="FO" label="Faroe Islands">Faroe Islands</option>
                        <option value="FI" label="Finland">Finland</option>
                        <option value="FR" label="France">France</option>
                        <option value="DE" label="Germany">Germany</option>
                        <option value="GI" label="Gibraltar">Gibraltar</option>
                        <option value="GR" label="Greece">Greece</option>
                        <option value="GG" label="Guernsey">Guernsey</option>
                        <option value="HU" label="Hungary">Hungary</option>
                        <option value="IS" label="Iceland">Iceland</option>
                        <option value="IE" label="Ireland">Ireland</option>
                        <option value="IM" label="Isle of Man">Isle of Man</option>
                        <option value="IT" label="Italy">Italy</option>
                        <option value="JE" label="Jersey">Jersey</option>
                        <option value="LV" label="Latvia">Latvia</option>
                        <option value="LI" label="Liechtenstein">Liechtenstein</option>
                        <option value="LT" label="Lithuania">Lithuania</option>
                        <option value="LU" label="Luxembourg">Luxembourg</option>
                        <option value="MK" label="Macedonia">Macedonia</option>
                        <option value="MT" label="Malta">Malta</option>
                        <option value="FX" label="Metropolitan France">Metropolitan France</option>
                        <option value="MD" label="Moldova">Moldova</option>
                        <option value="MC" label="Monaco">Monaco</option>
                        <option value="ME" label="Montenegro">Montenegro</option>
                        <option value="NL" label="Netherlands">Netherlands</option>
                        <option value="NO" label="Norway">Norway</option>
                        <option value="PL" label="Poland">Poland</option>
                        <option value="PT" label="Portugal">Portugal</option>
                        <option value="RO" label="Romania">Romania</option>
                        <option value="RU" label="Russia">Russia</option>
                        <option value="SM" label="San Marino">San Marino</option>
                        <option value="RS" label="Serbia">Serbia</option>
                        <option value="CS" label="Serbia and Montenegro">Serbia and Montenegro</option>
                        <option value="SK" label="Slovakia">Slovakia</option>
                        <option value="SI" label="Slovenia">Slovenia</option>
                        <option value="ES" label="Spain">Spain</option>
                        <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="SE" label="Sweden">Sweden</option>
                        <option value="CH" label="Switzerland">Switzerland</option>
                        <option value="UA" label="Ukraine">Ukraine</option>
                        <option value="SU" label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                        <option value="GB" label="United Kingdom">United Kingdom</option>
                        <option value="VA" label="Vatican City">Vatican City</option>
                        <option value="AX" label="Åland Islands">Åland Islands</option>
                    </optgroup>
                    <optgroup id="country-optgroup-Oceania" label="Oceania">
                        <option value="AS" label="American Samoa">American Samoa</option>
                        <option value="AQ" label="Antarctica">Antarctica</option>
                        <option value="AU" label="Australia">Australia</option>
                        <option value="BV" label="Bouvet Island">Bouvet Island</option>
                        <option value="IO" label="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="CX" label="Christmas Island">Christmas Island</option>
                        <option value="CC" label="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                        <option value="CK" label="Cook Islands">Cook Islands</option>
                        <option value="FJ" label="Fiji">Fiji</option>
                        <option value="PF" label="French Polynesia">French Polynesia</option>
                        <option value="TF" label="French Southern Territories">French Southern Territories</option>
                        <option value="GU" label="Guam">Guam</option>
                        <option value="HM" label="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                        <option value="KI" label="Kiribati">Kiribati</option>
                        <option value="MH" label="Marshall Islands">Marshall Islands</option>
                        <option value="FM" label="Micronesia">Micronesia</option>
                        <option value="NR" label="Nauru">Nauru</option>
                        <option value="NC" label="New Caledonia">New Caledonia</option>
                        <option value="NZ" label="New Zealand">New Zealand</option>
                        <option value="NU" label="Niue">Niue</option>
                        <option value="NF" label="Norfolk Island">Norfolk Island</option>
                        <option value="MP" label="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="PW" label="Palau">Palau</option>
                        <option value="PG" label="Papua New Guinea">Papua New Guinea</option>
                        <option value="PN" label="Pitcairn Islands">Pitcairn Islands</option>
                        <option value="WS" label="Samoa">Samoa</option>
                        <option value="SB" label="Solomon Islands">Solomon Islands</option>
                        <option value="GS" label="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                        <option value="TK" label="Tokelau">Tokelau</option>
                        <option value="TO" label="Tonga">Tonga</option>
                        <option value="TV" label="Tuvalu">Tuvalu</option>
                        <option value="UM" label="U.S. Minor Outlying Islands">U.S. Minor Outlying Islands</option>
                        <option value="VU" label="Vanuatu">Vanuatu</option>
                        <option value="WF" label="Wallis and Futuna">Wallis and Futuna</option>
                    </optgroup>
                </select>
                @error('country')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">{{ __('general.Password') }}</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" required name="password" placeholder="" aria-describedby="password" />

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
            </div>

            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">{{ __('general.Confirm Password') }}</label>
                <div class="input-group input-group-merge">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>

                
            </div>


            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                    <label class="form-check-label" for="terms-conditions">
                        <a href="#">{{ __("general.I agree privacy & terms") }}</a>
                    </label>
                </div>
            </div>
            <button class="btn btn-primary d-grid w-100" type="submit">{{ __('general.Register') }}</button>
        </form>

        <p class="text-center">
            <span>{{ __('general.Already have an account?') }}</span>
            <a href="{{ route('login') }}">
                <span>{{ __('general.Login') }}</span>
            </a>
        </p>
            
    </div>
</div>
<!-- /Register -->

@endsection

@section('script')
    <script>
        
        if (document.querySelector('input[name="type"]:checked').value == 2) { // client
            $('#showInClient').css('display', 'none');
        }
        $('input[name="type"]').change(function() {
            Usertype = document.querySelector('input[name="type"]:checked').value;
            // console.log(Usertype);
            if (Usertype == 1) { // client
                $('#showInClient').fadeIn();
            } else {
                $('#showInClient').css('display', 'none');
            }
        });
        
    </script>
@endsection
