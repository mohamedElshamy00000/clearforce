<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="utf-8">
  <meta name="x-apple-disable-message-reformatting">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
  <!--[if mso]>
    <xml><o:officedocumentsettings><o:pixelsperinch>96</o:pixelsperinch></o:officedocumentsettings></xml>
  <![endif]-->
  <style>
    .hover-underline:hover {
      text-decoration: underline !important;
    }
    @media (max-width: 600px) {
      .sm-w-full {
        width: 100% !important;
      }
      .sm-px-24 {
        padding-left: 20px !important;
        padding-right: 20px !important;
      }
      .sm-py-32 {
        padding-top: 20px !important;
        padding-bottom: 20px !important;
      }
    }
  </style>
</head>
@if ($data['message'] != 0)
<body style="margin: 0; width: 100%; padding: 0; word-break: break-word; -webkit-font-smoothing: antialiased;">
    <div style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; display: none;">This is an invoice for your purchase </div>
      <div role="article" aria-roledescription="email" aria-label="" lang="en" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;">
        <table style="width: 100%; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;" cellpadding="0" cellspacing="0" role="presentation">
          <tr>
            <td align="center" style="mso-line-height-rule: exactly; background-color: #eceff1; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;">
@endif
              
              <table class="sm-w-full" style="width: 600px;" cellpadding="0" cellspacing="0" role="presentation">
                  <tr>
                    <td class="sm-py-32 sm-px-24" style="mso-line-height-rule: exactly; padding: 25px; text-align: center; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;">
                      <a href="{{ route('home') }}" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;">
                        <img src="{{ asset('frontend/assets/images/logo-dark.png') }}" width="155" alt="{{config('app.name')}}" style="max-width: 100%; vertical-align: middle; line-height: 100%; border: 0;">
                      </a>
                    </td>
                  </tr>
                <tr>
                  <td align="center" class="sm-px-24" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;">
                    <table style="width: 100%;" cellpadding="0" cellspacing="0" role="presentation">
                      <tr>
                        <td class="sm-px-24" style="mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 16px; line-height: 24px; color: #626262;">
                          @if ($data['message'] != 0)
                          <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;">Hey</p>
                          <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 20px; font-weight: 700; color: #111111;">Mail from : {{ auth()->user()->name }}</p>
                          <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 20px; font-weight: 700; color: #111111;">{{ auth()->user()->email }}</p>
                          <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 24px;">
                            {{ $data['message'] }}
                          </p>
                          @endif

                          <table style="width: 100%;" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                              <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;">
                                <h3 style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin-top: 0; text-align: left; font-size: 14px; font-weight: 700;">INVOICE # {{ $data['project']['Invoice']['id'] }}</h3>
                              </td>
                              <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;">
                                <h3 style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin-top: 0; text-align: right; font-size: 14px; font-weight: 700;">
                                  {{ $data['project']['Invoice']['created_at']->format('d-m-Y') }}
                                </h3>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;">
                                <table style="width: 100%;" cellpadding="0" cellspacing="0" role="presentation">
                                  <tr>
                                    <th align="left" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; padding-bottom: 8px;width:15%">
                                      <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;">Item</p>
                                    </th>
                                    <th align="left" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; padding-bottom: 8px;width:45%">
                                      <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;">Description</p>
                                    </th>
                                    <th align="left" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; padding-bottom: 8px;width:20%">
                                      <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;">date</p>
                                    </th>
                                    <th align="left" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; padding-bottom: 8px;width:20%">
                                      <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;">Amount</p>
                                    </th>
                                  </tr>
                                  <tr>
                                      <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;  padding-top: 10px; padding-bottom: 10px; font-size: 16px;width:15%">{{ $data['project']['Invoice']['comment'] }}</td>
                                      <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;  padding-top: 10px; padding-bottom: 10px; font-size: 16px;width:45%">customs clearnace service</td>
                                      <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;  padding-top: 10px; padding-bottom: 10px; font-size: 16px;width:20%">{{ $data['project']['Invoice']['created_at']->format('d-m-Y') }}</td>
                                      <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;  padding-top: 10px; padding-bottom: 10px; font-size: 16px;width:20%">{{ $data['project']['Invoice']['amount'] }} sar</td>
                                  </tr>
                                  @foreach ($data['project']['ProjectInvoice'] as $pInvoice)
                                  <tr>
                                      <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;  padding-top: 10px; padding-bottom: 10px; font-size: 16px;width:15%">{{ $pInvoice->code }}</td>
                                      <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;  padding-top: 10px; padding-bottom: 10px; font-size: 16px;width:45%">{{ $pInvoice->desc }} - Off-platform payment</td>
                                      <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;  padding-top: 10px; padding-bottom: 10px; font-size: 16px;width:20%">{{ $pInvoice->created_at->format('d/m/Y') }}</td>
                                      <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;  padding-top: 10px; padding-bottom: 10px; font-size: 16px;width:20%">{{ $pInvoice->amount }} sar</td>
                                  </tr>
                                  @endforeach

                                  <tr>
                                    <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; ">
                                      <p align="left" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin: 0; padding-right: 16px; text-align: left; font-size: 16px; font-weight: 700; line-height: 24px;">
                                        Total
                                      </p>
                                    </td>
                                    <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; width: 20%;">
                                      <p align="left" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin: 0; text-align: left; font-size: 16px; font-weight: 700; line-height: 24px;">
                                          {{ $data['total'] }} sar
                                      </p>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>

                          <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin-top: 6px; margin-bottom: 20px; font-size: 16px; line-height: 24px;">
                            If you have any questions about this invoice, simply reply to this email or reach out to our
                            <a href="{{ route('contact.us') }}" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly;">support team</a> for help.
                          </p>
                          <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; margin-top: 6px; margin-bottom: 20px; font-size: 16px; line-height: 24px;">
                            Cheers,
                            <br>The ClearForce Team
                          </p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              <tr>
              <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; height: 20px;"></td>
              </tr>
              <tr>
              <td style="mso-line-height-rule: exactly; padding-left: 48px; padding-right: 48px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 14px; color: #eceff1;">
                  <p style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; color: #263238;">
                  Use of our service and website is subject to our
                  <a href="{{ route('terms') }}" class="hover-underline" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; color: #7367f0; text-decoration: none;">Terms of Use</a> and
                  <a href="{{ route('privacy') }}" class="hover-underline" style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; color: #7367f0; text-decoration: none;">Privacy Policy</a>.
                  </p>
              </td>
              </tr>
              <tr>
              <td style="font-family: 'Montserrat', sans-serif; mso-line-height-rule: exactly; height: 16px;"></td>
              </tr>
            </table>
@if ($data['message'] != 0)
        </td>
      </tr>
    </table>
  </div>
</body>
</html>

@endif