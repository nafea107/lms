<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /* $countries = [

         ];

         foreach ($countries as $country) {

             $created_country = Country::create($country);

         }*/

        $countries = [
            ["name" => ["ar" => 'أفغانستان', "en" => 'Afghanistan', "fr" => 'Afghanistan', "ku" => 'ئافغانیستان'], 'country_code' => 'AF', 'phone_code' => '93'],
            ["name" => ["ar" => 'ألبانيا', "en" => 'Albania', "fr" => 'Albanie', "ku" => 'ئلبانی'], 'country_code' => 'AL', 'phone_code' => '355'],
            ["name" => ["ar" => 'الجزائر', "en" => 'Algeria', "fr" => 'Algérie', "ku" => 'الجزایر'], 'country_code' => 'DZ', 'phone_code' => '213'],
            ["name" => ["ar" => 'أندورا', "en" => 'Andorra', "fr" => 'Andorre', "ku" => 'ئاندورا'], 'country_code' => 'AD', 'phone_code' => '376'],
            ["name" => ["ar" => 'أنغولا', "en" => 'Angola', "fr" => 'Angola', "ku" => 'ئنگولا'], 'country_code' => 'AO', 'phone_code' => '244'],
            ["name" => ["ar" => 'أنتيغوا وبربودا', "en" => 'Antigua and Barbuda', "fr" => 'Antigua-et-Barbuda', "ku" => 'ئانتیکا و باربودا'], 'country_code' => 'AG', 'phone_code' => '1-268'],
            ["name" => ["ar" => 'الأرجنتين', "en" => 'Argentina', "fr" => 'Argentine', "ku" => 'ئارژنتین'], 'country_code' => 'AR', 'phone_code' => '54'],
            ["name" => ["ar" => 'أرمينيا', "en" => 'Armenia', "fr" => 'Arménie', "ku" => 'ئارمینیە'], 'country_code' => 'AM', 'phone_code' => '374'],
            ["name" => ["ar" => 'أستراليا', "en" => 'Australia', "fr" => 'Australie', "ku" => 'ئاسترالیای'], 'country_code' => 'AU', 'phone_code' => '61'],
            ["name" => ["ar" => 'النمسا', "en" => 'Austria', "fr" => 'Autriche', "ku" => 'ئەوستریا'], 'country_code' => 'AT', 'phone_code' => '43'],
            ["name" => ["ar" => 'أذربيجان', "en" => 'Azerbaijan', "fr" => 'Azerbaïdjan', "ku" => 'ئازربایجان'], 'country_code' => 'AZ', 'phone_code' => '994'],
            ["name" => ["ar" => 'باهاماس', "en" => 'Bahamas', "fr" => 'Bahamas', "ku" => 'باهاماس'], 'country_code' => 'BS', 'phone_code' => '1-242'],
            ["name" => ["ar" => 'بحرين', "en" => 'Bahrain', "fr" => 'Bahreïn', "ku" => 'بحرین'], 'country_code' => 'BH', 'phone_code' => '973'],
            ["name" => ["ar" => 'بنغلاديش', "en" => 'Bangladesh', "fr" => 'Bangladesh', "ku" => 'بنگلادیش'], 'country_code' => 'BD', 'phone_code' => '880'],
            ["name" => ["ar" => 'باربادوس', "en" => 'Barbados', "fr" => 'Barbade', "ku" => 'باربادوس'], 'country_code' => 'BB', 'phone_code' => '1-246'],
            ["name" => ["ar" => 'بيلاروس', "en" => 'Belarus', "fr" => 'Biélorussie', "ku" => 'بیلاروس'], 'country_code' => 'BY', 'phone_code' => '375'],
            ["name" => ["ar" => 'بلجيكا', "en" => 'Belgium', "fr" => 'Belgique', "ku" => 'بلژیک'], 'country_code' => 'BE', 'phone_code' => '32'],
            ["name" => ["ar" => 'بليز', "en" => 'Belize', "fr" => 'Belize', "ku" => 'بلیز'], 'country_code' => 'BZ', 'phone_code' => '501'],
            ["name" => ["ar" => 'بنين', "en" => 'Benin', "fr" => 'Bénin', "ku" => 'بنین'], 'country_code' => 'BJ', 'phone_code' => '229'],
            ["name" => ["ar" => 'برمودا', "en" => 'Bermuda', "fr" => 'Bermudes', "ku" => 'برمودا'], 'country_code' => 'BM', 'phone_code' => '1-441'],
            ["name" => ["ar" => 'بوتان', "en" => 'Bhutan', "fr" => 'Bhoutan', "ku" => 'بوتان'], 'country_code' => 'BT', 'phone_code' => '975'],
            ["name" => ["ar" => 'بوليفيا', "en" => 'Bolivia', "fr" => 'Bolivie', "ku" => 'بولیفیا'], 'country_code' => 'BO', 'phone_code' => '591'],
            ["name" => ["ar" => 'البوسنة والهرسك', "en" => 'Bosnia and Herzegovina', "fr" => 'Bosnie-Herzégovine', "ku" => 'بۆسنی و هەرزەگووینە'], 'country_code' => 'BA', 'phone_code' => '387'],
            ["name" => ["ar" => 'بوتسوانا', "en" => 'Botswana', "fr" => 'Botswana', "ku" => 'بۆتسوانا'], 'country_code' => 'BW', 'phone_code' => '267'],
            ["name" => ["ar" => 'البرازيل', "en" => 'Brazil', "fr" => 'Brésil', "ku" => 'برازیل'], 'country_code' => 'BR', 'phone_code' => '55'],
            ["name" => ["ar" => 'بروناي', "en" => 'Brunei', "fr" => 'Brunei', "ku" => 'برونای'], 'country_code' => 'BN', 'phone_code' => '673'],
            ["name" => ["ar" => 'بلغاريا', "en" => 'Bulgaria', "fr" => 'Bulgarie', "ku" => 'بلغاریا'], 'country_code' => 'BG', 'phone_code' => '359'],
            ["name" => ["ar" => 'بورا بورا', "en" => 'Bora Bora', "fr" => 'Bora Bora', "ku" => 'بورا بورا'], 'country_code' => 'PF', 'phone_code' => '689'],
            ["name" => ["ar" => 'بوركينا فاسو', "en" => 'Burkina Faso', "fr" => 'Burkina Faso', "ku" => 'بوردن فاسو'], 'country_code' => 'BF', 'phone_code' => '226'],
            ["name" => ["ar" => 'بوروندي', "en" => 'Burundi', "fr" => 'Burundi', "ku" => 'بوروندي'], 'country_code' => 'BI', 'phone_code' => '257'],
            ["name" => ["ar" => 'كامبوديا', "en" => 'Cambodia', "fr" => 'Cambodge', "ku" => 'کامبوج'], 'country_code' => 'KH', 'phone_code' => '855'],
            ["name" => ["ar" => 'الكاميرون', "en" => 'Cameroon', "fr" => 'Cameroun', "ku" => 'کامرون'], 'country_code' => 'CM', 'phone_code' => '237'],
            ["name" => ["ar" => 'كندا', "en" => 'Canada', "fr" => 'Canada', "ku" => 'کەنەدا'], 'country_code' => 'CA', 'phone_code' => '1'],
            ["name" => ["ar" => 'الرأس الأخضر', "en" => 'Cape Verde', "fr" => 'Cap-Vert', "ku" => 'کاپ ورد'], 'country_code' => 'CV', 'phone_code' => '238'],
            ["name" => ["ar" => 'تشيلي', "en" => 'Chile', "fr" => 'Chili', "ku" => 'چیلی'], 'country_code' => 'CL', 'phone_code' => '56'],
            ["name" => ["ar" => 'الصين', "en" => 'China', "fr" => 'Chine', "ku" => 'چین'], 'country_code' => 'CN', 'phone_code' => '86'],
            ["name" => ["ar" => 'كولومبيا', "en" => 'Colombia', "fr" => 'Colombie', "ku" => 'کولومبیا'], 'country_code' => 'CO', 'phone_code' => '57'],
            ["name" => ["ar" => 'الكونغو', "en" => 'Congo', "fr" => 'Congo', "ku" => 'کۆنگو'], 'country_code' => 'CG', 'phone_code' => '242'],
            ["name" => ["ar" => 'الكونغو الديمقراطية', "en" => 'Democratic Republic of the Congo', "fr" => 'République démocratique du Congo', "ku" => 'کۆنگوی دیموکراتی'], 'country_code' => 'CD', 'phone_code' => '243'],
            ["name" => ["ar" => 'كوستاريكا', "en" => 'Costa Rica', "fr" => 'Costa Rica', "ku" => 'کۆستاریکا'], 'country_code' => 'CR', 'phone_code' => '506'],
            ["name" => ["ar" => 'كرواتيا', "en" => 'Croatia', "fr" => 'Croatie', "ku" => 'کرواتیا'], 'country_code' => 'HR', 'phone_code' => '385'],
            ["name" => ["ar" => 'كوبا', "en" => 'Cuba', "fr" => 'Cuba', "ku" => 'کوبا'], 'country_code' => 'CU', 'phone_code' => '53'],
            ["name" => ["ar" => 'قبرص', "en" => 'Cyprus', "fr" => 'Chypre', "ku" => 'قبرس'], 'country_code' => 'CY', 'phone_code' => '357'],
            ["name" => ["ar" => 'جمهورية التشيك', "en" => 'Czech Republic', "fr" => 'République tchèque', "ku" => 'چەکەی جۆراوجۆر'], 'country_code' => 'CZ', 'phone_code' => '420'],
            ["name" => ["ar" => 'الدنمارك', "en" => 'Denmark', "fr" => 'Danemark', "ku" => 'دنمارک'], 'country_code' => 'DK', 'phone_code' => '45'],
            ["name" => ["ar" => 'جيبوتي', "en" => 'Djibouti', "fr" => 'Djibouti', "ku" => 'جیبووتی'], 'country_code' => 'DJ', 'phone_code' => '253'],
            ["name" => ["ar" => 'دومينيكا', "en" => 'Dominica', "fr" => 'Dominique', "ku" => 'دومینیکا'], 'country_code' => 'DM', 'phone_code' => '1-767'],
            ["name" => ["ar" => 'جمهورية الدومينيكان', "en" => 'Dominican Republic', "fr" => 'République dominicaine', "ku" => 'جمهوری دۆمینیك'], 'country_code' => 'DO', 'phone_code' => '1-809'],
            ["name" => ["ar" => 'تيمور الشرقية', "en" => 'East Timor', "fr" => 'Timor oriental', "ku" => 'تیمور شەرقی'], 'country_code' => 'TL', 'phone_code' => '670'],
            ["name" => ["ar" => 'إكوادور', "en" => 'Ecuador', "fr" => 'Équateur', "ku" => 'ئیکوادور'], 'country_code' => 'EC', 'phone_code' => '593'],
            ["name" => ["ar" => 'مصر', "en" => 'Egypt', "fr" => 'Égypte', "ku" => 'مصر'], 'country_code' => 'EG', 'phone_code' => '20'],
            ["name" => ["ar" => 'السلفادور', "en" => 'El Salvador', "fr" => 'El Salvador', "ku" => 'السلفادور'], 'country_code' => 'SV', 'phone_code' => '503'],
            ["name" => ["ar" => 'غينيا الاستوائية', "en" => 'Equatorial Guinea', "fr" => 'Guinée équatoriale', "ku" => 'گینیا ئەستوایی'], 'country_code' => 'GQ', 'phone_code' => '240'],
            ["name" => ["ar" => 'إريتريا', "en" => 'Eritrea', "fr" => 'Érythrée', "ku" => 'ئیریتریا'], 'country_code' => 'ER', 'phone_code' => '291'],
            ["name" => ["ar" => 'استونيا', "en" => 'Estonia', "fr" => 'Estonie', "ku" => 'استونیا'], 'country_code' => 'EE', 'phone_code' => '372'],
            ["name" => ["ar" => 'إثيوبيا', "en" => 'Ethiopia', "fr" => 'Éthiopie', "ku" => 'ئیتیۆپی'], 'country_code' => 'ET', 'phone_code' => '251'],
            ["name" => ["ar" => 'فجي', "en" => 'Fiji', "fr" => 'Fidji', "ku" => 'فجی'], 'country_code' => 'FJ', 'phone_code' => '679'],
            ["name" => ["ar" => 'فنلندا', "en" => 'Finland', "fr" => 'Finlande', "ku" => 'فینلندا'], 'country_code' => 'FI', 'phone_code' => '358'],
            ["name" => ["ar" => 'فرنسا', "en" => 'France', "fr" => 'France', "ku" => 'فرانسه'], 'country_code' => 'FR', 'phone_code' => '33'],
            ["name" => ["ar" => 'الغابون', "en" => 'Gabon', "fr" => 'Gabon', "ku" => 'گابۆن'], 'country_code' => 'GA', 'phone_code' => '241'],
            ["name" => ["ar" => 'غامبيا', "en" => 'Gambia', "fr" => 'Gambie', "ku" => 'غامبیا'], 'country_code' => 'GM', 'phone_code' => '220'],
            ["name" => ["ar" => 'جورجيا', "en" => 'Georgia', "fr" => 'Géorgie', "ku" => 'جورجیا'], 'country_code' => 'GE', 'phone_code' => '995'],
            ["name" => ["ar" => 'ألمانيا', "en" => 'Germany', "fr" => 'Allemagne', "ku" => 'ئەلمانیا'], 'country_code' => 'DE', 'phone_code' => '49'],
            ["name" => ["ar" => 'غانا', "en" => 'Ghana', "fr" => 'Ghana', "ku" => 'غانا'], 'country_code' => 'GH', 'phone_code' => '233'],
            ["name" => ["ar" => 'غينيا', "en" => 'Guinea', "fr" => 'Guinée', "ku" => 'غینیا'], 'country_code' => 'GN', 'phone_code' => '224'],
            ["name" => ["ar" => 'غينيا بيساو', "en" => 'Guinea-Bissau', "fr" => 'Guinée-Bissau', "ku" => 'غینیا بیساو'], 'country_code' => 'GW', 'phone_code' => '245'],
            ["name" => ["ar" => 'هندوراس', "en" => 'Honduras', "fr" => 'Honduras', "ku" => 'هندوراس'], 'country_code' => 'HN', 'phone_code' => '504'],
            ["name" => ["ar" => 'هنغاريا', "en" => 'Hungary', "fr" => 'Hongrie', "ku" => 'هنگاری'], 'country_code' => 'HU', 'phone_code' => '36'],
            ["name" => ["ar" => 'آيسلندا', "en" => 'Iceland', "fr" => 'Islande', "ku" => 'آیسلند'], 'country_code' => 'IS', 'phone_code' => '354'],
            ["name" => ["ar" => 'الهند', "en" => 'India', "fr" => 'Inde', "ku" => 'هند'], 'country_code' => 'IN', 'phone_code' => '91'],
            ["name" => ["ar" => 'اندونيسيا', "en" => 'Indonesia', "fr" => 'Indonésie', "ku" => 'ئندۆنیسیا'], 'country_code' => 'ID', 'phone_code' => '62'],
            ["name" => ["ar" => 'ايران', "en" => 'Iran', "fr" => 'Iran', "ku" => 'ئیران'], 'country_code' => 'IR', 'phone_code' => '98'],
            ["name" => ["ar" => 'العراق', "en" => 'Iraq', "fr" => 'Irak', "ku" => 'عێراق'], 'country_code' => 'IQ', 'phone_code' => '964'],
            ["name" => ["ar" => 'ايرلندا', "en" => 'Ireland', "fr" => 'Irlande', "ku" => 'ئیرلندا'], 'country_code' => 'IE', 'phone_code' => '353'],
            ["name" => ["ar" => 'إسرائيل', "en" => 'Israel', "fr" => 'Israël', "ku" => 'ئسرائیل'], 'country_code' => 'IL', 'phone_code' => '972'],
            ["name" => ["ar" => 'ايطاليا', "en" => 'Italy', "fr" => 'Italie', "ku" => 'ئیتالیای'], 'country_code' => 'IT', 'phone_code' => '39'],
            ["name" => ["ar" => 'جامايكا', "en" => 'Jamaica', "fr" => 'Jamaïque', "ku" => 'جامائیکا'], 'country_code' => 'JM', 'phone_code' => '1-876'],
            ["name" => ["ar" => 'اليابان', "en" => 'Japan', "fr" => 'Japon', "ku" => 'یابان'], 'country_code' => 'JP', 'phone_code' => '81'],
            ["name" => ["ar" => 'الأردن', "en" => 'Jordan', "fr" => 'Jordanie', "ku" => 'الأردن'], 'country_code' => 'JO', 'phone_code' => '962'],
            ["name" => ["ar" => 'كازاخستان', "en" => 'Kazakhstan', "fr" => 'Kazakhstan', "ku" => 'کازاخستان'], 'country_code' => 'KZ', 'phone_code' => '7'],
            ["name" => ["ar" => 'كينيا', "en" => 'Kenya', "fr" => 'Kenya', "ku" => 'کینیا'], 'country_code' => 'KE', 'phone_code' => '254'],
            ["name" => ["ar" => 'كوسوفو', "en" => 'Kosovo', "fr" => 'Kosovo', "ku" => 'کوسۆڤو'], 'country_code' => 'XK', 'phone_code' => '383'],
            ["name" => ["ar" => 'كرواتيا', "en" => 'Croatia', "fr" => 'Croatie', "ku" => 'کرواتیا'], 'country_code' => 'HR', 'phone_code' => '385'],
            ["name" => ["ar" => 'لاوس', "en" => 'Laos', "fr" => 'Laos', "ku" => 'لاوس'], 'country_code' => 'LA', 'phone_code' => '856'],
            ["name" => ["ar" => 'لاتفيا', "en" => 'Latvia', "fr" => 'Lettonie', "ku" => 'لاتفیا'], 'country_code' => 'LV', 'phone_code' => '371'],
            ["name" => ["ar" => 'لبنان', "en" => 'Lebanon', "fr" => 'Liban', "ku" => 'لبنان'], 'country_code' => 'LB', 'phone_code' => '961'],
            ["name" => ["ar" => 'ليسوتو', "en" => 'Lesotho', "fr" => 'Lesotho', "ku" => 'لیسوتو'], 'country_code' => 'LS', 'phone_code' => '266'],
            ["name" => ["ar" => 'ليبيريا', "en" => 'Liberia', "fr" => 'Libéria', "ku" => 'لیبریا'], 'country_code' => 'LR', 'phone_code' => '231'],
            ["name" => ["ar" => 'ليتوانيا', "en" => 'Lithuania', "fr" => 'Lituanie', "ku" => 'لیتوانیا'], 'country_code' => 'LT', 'phone_code' => '370'],
            ["name" => ["ar" => 'لوكسمبورغ', "en" => 'Luxembourg', "fr" => 'Luxembourg', "ku" => 'لوکزامبورگ'], 'country_code' => 'LU', 'phone_code' => '352'],
            ["name" => ["ar" => 'مدغشقر', "en" => 'Madagascar', "fr" => 'Madagascar', "ku" => 'ماداکاسکار'], 'country_code' => 'MG', 'phone_code' => '261'],
            ["name" => ["ar" => 'مالاوي', "en" => 'Malawi', "fr" => 'Malawi', "ku" => 'مالاوی'], 'country_code' => 'MW', 'phone_code' => '265'],
            ["name" => ["ar" => 'ماليزيا', "en" => 'Malaysia', "fr" => 'Malaisie', "ku" => 'مالیزیا'], 'country_code' => 'MY', 'phone_code' => '60'],
            ["name" => ["ar" => 'مالطا', "en" => 'Malta', "fr" => 'Malte', "ku" => 'مالطا'], 'country_code' => 'MT', 'phone_code' => '356'],
            ["name" => ["ar" => 'جزر المالديف', "en" => 'Maldives', "fr" => 'Maldives', "ku" => 'مالديف'], 'country_code' => 'MV', 'phone_code' => '960'],
            ["name" => ["ar" => 'مالي', "en" => 'Mali', "fr" => 'Mali', "ku" => 'مالی'], 'country_code' => 'ML', 'phone_code' => '223'],
            ["name" => ["ar" => 'المكسيك', "en" => 'Mexico', "fr" => 'Mexique', "ku" => 'مکسیکو'], 'country_code' => 'MX', 'phone_code' => '52'],
            ["name" => ["ar" => 'ميكرونيزيا', "en" => 'Micronesia', "fr" => 'Micronésie', "ku" => 'میکرونیزیا'], 'country_code' => 'FM', 'phone_code' => '691'],
            ["name" => ["ar" => 'مولدوفيا', "en" => 'Moldova', "fr" => 'Moldavie', "ku" => 'مولداڤیا'], 'country_code' => 'MD', 'phone_code' => '373'],
            ["name" => ["ar" => 'موناكو', "en" => 'Monaco', "fr" => 'Monaco', "ku" => 'موناكو'], 'country_code' => 'MC', 'phone_code' => '377'],
            ["name" => ["ar" => 'منغوليا', "en" => 'Mongolia', "fr" => 'Mongolie', "ku" => 'مغولستان'], 'country_code' => 'MN', 'phone_code' => '976'],
            ["name" => ["ar" => 'مقدونيا', "en" => 'North Macedonia', "fr" => 'Macédoine du Nord', "ku" => 'مقدونیا'], 'country_code' => 'MK', 'phone_code' => '389'],
            ["name" => ["ar" => 'المغرب', "en" => 'Morocco', "fr" => 'Maroc', "ku" => 'مغری'], 'country_code' => 'MA', 'phone_code' => '212'],
            ["name" => ["ar" => 'موزمبيق', "en" => 'Mozambique', "fr" => 'Mozambique', "ku" => 'موزامبیک'], 'country_code' => 'MZ', 'phone_code' => '258'],
            ["name" => ["ar" => 'ناميبيا', "en" => 'Namibia', "fr" => 'Namibie', "ku" => 'نامیبیا'], 'country_code' => 'NA', 'phone_code' => '264'],
            ["name" => ["ar" => 'ناورو', "en" => 'Nauru', "fr" => 'Nauru', "ku" => 'ناورو'], 'country_code' => 'NR', 'phone_code' => '674'],
            ["name" => ["ar" => 'نيبال', "en" => 'Nepal', "fr" => 'Népal', "ku" => 'نیبال'], 'country_code' => 'NP', 'phone_code' => '977'],
            ["name" => ["ar" => 'هولندا', "en" => 'Netherlands', "fr" => 'Pays-Bas', "ku" => 'هولندا'], 'country_code' => 'NL', 'phone_code' => '31'],
            ["name" => ["ar" => 'نيوزيلندا', "en" => 'New Zealand', "fr" => 'Nouvelle-Zélande', "ku" => 'نیوزیلندا'], 'country_code' => 'NZ', 'phone_code' => '64'],
            ["name" => ["ar" => 'نيكاراغوا', "en" => 'Nicaragua', "fr" => 'Nicaragua', "ku" => 'نیکاراگوا'], 'country_code' => 'NI', 'phone_code' => '505'],
            ["name" => ["ar" => 'نيجيريا', "en" => 'Nigeria', "fr" => 'Nigeria', "ku" => 'نیجیریا'], 'country_code' => 'NG', 'phone_code' => '234'],
            ["name" => ["ar" => 'النرويج', "en" => 'Norway', "fr" => 'Norvège', "ku" => 'نروژ'], 'country_code' => 'NO', 'phone_code' => '47'],
            ["name" => ["ar" => 'عمان', "en" => 'Oman', "fr" => 'Oman', "ku" => 'عمان'], 'country_code' => 'OM', 'phone_code' => '968'],
            ["name" => ["ar" => 'باكستان', "en" => 'Pakistan', "fr" => 'Pakistan', "ku" => 'پاکستان'], 'country_code' => 'PK', 'phone_code' => '92'],
            ["name" => ["ar" => 'بالاو', "en" => 'Palau', "fr" => 'Palau', "ku" => 'پالاو'], 'country_code' => 'PW', 'phone_code' => '680'],
            ["name" => ["ar" => 'فلسطين', "en" => 'Palestine', "fr" => 'Palestine', "ku" => 'فلسطین'], 'country_code' => 'PS', 'phone_code' => '970'],
            ["name" => ["ar" => 'بنما', "en" => 'Panama', "fr" => 'Panama', "ku" => 'پاناما'], 'country_code' => 'PA', 'phone_code' => '507'],
            ["name" => ["ar" => 'بابوا غينيا الجديدة', "en" => 'Papua New Guinea', "fr" => 'Papouasie-Nouvelle-Guinée', "ku" => 'پاپوای گینه نو'], 'country_code' => 'PG', 'phone_code' => '675'],
            ["name" => ["ar" => 'باراغواي', "en" => 'Paraguay', "fr" => 'Paraguay', "ku" => 'پارغواي'], 'country_code' => 'PY', 'phone_code' => '595'],
            ["name" => ["ar" => 'بيرو', "en" => 'Peru', "fr" => 'Pérou', "ku" => 'پیرú'], 'country_code' => 'PE', 'phone_code' => '51'],
            ["name" => ["ar" => 'الفلبين', "en" => 'Philippines', "fr" => 'Philippines', "ku" => 'فلیپین'], 'country_code' => 'PH', 'phone_code' => '63'],
            ["name" => ["ar" => 'بولندا', "en" => 'Poland', "fr" => 'Pologne', "ku" => 'پولندا'], 'country_code' => 'PL', 'phone_code' => '48'],
            ["name" => ["ar" => 'البرتغال', "en" => 'Portugal', "fr" => 'Portugal', "ku" => 'پرتوگال'], 'country_code' => 'PT', 'phone_code' => '351'],
            ["name" => ["ar" => 'قطر', "en" => 'Qatar', "fr" => 'Qatar', "ku" => 'قطر'], 'country_code' => 'QA', 'phone_code' => '974'],
            ["name" => ["ar" => 'رومانيا', "en" => 'Romania', "fr" => 'Roumanie', "ku" => 'رومانیا'], 'country_code' => 'RO', 'phone_code' => '40'],
            ["name" => ["ar" => 'روسيا', "en" => 'Russia', "fr" => 'Russie', "ku" => 'روسیه'], 'country_code' => 'RU', 'phone_code' => '7'],
            ["name" => ["ar" => 'رأس الأخضر', "en" => 'São Tomé and Príncipe', "fr" => 'Sao Tomé-et-Principe', "ku" => 'سائو تومé و برینسیپی'], 'country_code' => 'ST', 'phone_code' => '239'],
            ["name" => ["ar" => 'سنغافورة', "en" => 'Singapore', "fr" => 'Singapour', "ku" => 'سینگافور'], 'country_code' => 'SG', 'phone_code' => '65'],
            ["name" => ["ar" => 'سلوفاكيا', "en" => 'Slovakia', "fr" => 'Slovaquie', "ku" => 'سلاواکی'], 'country_code' => 'SK', 'phone_code' => '421'],
            ["name" => ["ar" => 'سلوفينيا', "en" => 'Slovenia', "fr" => 'Slovénie', "ku" => 'سلوڤینیا'], 'country_code' => 'SI', 'phone_code' => '386'],
            ["name" => ["ar" => 'جزر سليمان', "en" => 'Solomon Islands', "fr" => 'Îles Salomon', "ku" => 'جزیرة سلیمان'], 'country_code' => 'SB', 'phone_code' => '677'],
            ["name" => ["ar" => 'الصومال', "en" => 'Somalia', "fr" => 'Somalie', "ku" => 'صومالیا'], 'country_code' => 'SO', 'phone_code' => '252'],
            ["name" => ["ar" => 'جنوب أفريقيا', "en" => 'South Africa', "fr" => 'Afrique du Sud', "ku" => 'ئاگةی سەوزی'], 'country_code' => 'ZA', 'phone_code' => '27'],
            ["name" => ["ar" => 'كوريا الجنوبية', "en" => 'South Korea', "fr" => 'Corée du Sud', "ku" => 'کوریای باشوور'], 'country_code' => 'KR', 'phone_code' => '82'],
            ["name" => ["ar" => 'جنوب السودان', "en" => 'South Sudan', "fr" => 'Soudan du Sud', "ku" => 'کوردی جنوبی'], 'country_code' => 'SS', 'phone_code' => '211'],
            ["name" => ["ar" => 'إسبانيا', "en" => 'Spain', "fr" => 'Espagne', "ku" => 'ئیسبانیا'], 'country_code' => 'ES', 'phone_code' => '34'],
            ["name" => ["ar" => 'سيراليون', "en" => 'Sierra Leone', "fr" => 'Sierra Leone', "ku" => 'سیرا لیون'], 'country_code' => 'SL', 'phone_code' => '232'],
            ["name" => ["ar" => 'سنغافورة', "en" => 'Singapore', "fr" => 'Singapour', "ku" => 'سینکاپور'], 'country_code' => 'SG', 'phone_code' => '65'],
            ["name" => ["ar" => 'سريلانكا', "en" => 'Sri Lanka', "fr" => 'Sri Lanka', "ku" => 'سریلانکا'], 'country_code' => 'LK', 'phone_code' => '94'],
            ["name" => ["ar" => 'السودان', "en" => 'Sudan', "fr" => 'Soudan', "ku" => 'سودان'], 'country_code' => 'SD', 'phone_code' => '249'],
            ["name" => ["ar" => 'سورينام', "en" => 'Suriname', "fr" => 'Suriname', "ku" => 'سورینام'], 'country_code' => 'SR', 'phone_code' => '597'],
            ["name" => ["ar" => 'سويزلندا', "en" => 'Switzerland', "fr" => 'Suisse', "ku" => 'سویزرلاند'], 'country_code' => 'CH', 'phone_code' => '41'],
            ["name" => ["ar" => 'سيريلانكا', "en" => 'Sri Lanka', "fr" => 'Sri Lanka', "ku" => 'سریلانکا'], 'country_code' => 'LK', 'phone_code' => '94'],
            ["name" => ["ar" => 'طاجيكستان', "en" => 'Tajikistan', "fr" => 'Tadjikistan', "ku" => 'تاجیکستان'], 'country_code' => 'TJ', 'phone_code' => '992'],
            ["name" => ["ar" => 'تايلاند', "en" => 'Thailand', "fr" => 'Thaïlande', "ku" => 'تایلند'], 'country_code' => 'TH', 'phone_code' => '66'],
            ["name" => ["ar" => 'توجو', "en" => 'Togo', "fr" => 'Togo', "ku" => 'تۆگۆ'], 'country_code' => 'TG', 'phone_code' => '228'],
            ["name" => ["ar" => 'تونغا', "en" => 'Tonga', "fr" => 'Tonga', "ku" => 'تۆنگا'], 'country_code' => 'TO', 'phone_code' => '676'],
            ["name" => ["ar" => 'ترينيداد وتوباغو', "en" => 'Trinidad and Tobago', "fr" => 'Trinité-et-Tobago', "ku" => 'ترینیداد و توباگو'], 'country_code' => 'TT', 'phone_code' => '1-868'],
            ["name" => ["ar" => 'تونس', "en" => 'Tunisia', "fr" => 'Tunisie', "ku" => 'تونس'], 'country_code' => 'TN', 'phone_code' => '216'],
            ["name" => ["ar" => 'تركيا', "en" => 'Turkey', "fr" => 'Turquie', "ku" => 'تُرکی'], 'country_code' => 'TR', 'phone_code' => '90'],
            ["name" => ["ar" => 'تركمانستان', "en" => 'Turkmenistan', "fr" => 'Turkménistan', "ku" => 'تُرکمنستان'], 'country_code' => 'TM', 'phone_code' => '993'],
            ["name" => ["ar" => 'أوغندا', "en" => 'Uganda', "fr" => 'Ouganda', "ku" => 'ئۆگاندا'], 'country_code' => 'UG', 'phone_code' => '256'],
            ["name" => ["ar" => 'أوكرانيا', "en" => 'Ukraine', "fr" => 'Ukraine', "ku" => 'ئوکڕاینی'], 'country_code' => 'UA', 'phone_code' => '380'],
            ["name" => ["ar" => 'الإمارات العربية المتحدة', "en" => 'United Arab Emirates', "fr" => 'Émirats arabes unis', "ku" => 'ئیماراتە عەرەبییە نوێیە'], 'country_code' => 'AE', 'phone_code' => '971'],
            ["name" => ["ar" => 'المملكة المتحدة', "en" => 'United Kingdom', "fr" => 'Royaume-Uni', "ku" => 'ئینگلیس'], 'country_code' => 'GB', 'phone_code' => '44'],
            ["name" => ["ar" => 'الولايات المتحدة', "en" => 'United States', "fr" => 'États-Unis', "ku" => 'ئامریکا'], 'country_code' => 'US', 'phone_code' => '1'],
            ["name" => ["ar" => 'أوروغواي', "en" => 'Uruguay', "fr" => 'Uruguay', "ku" => 'ئورۇغوای'], 'country_code' => 'UY', 'phone_code' => '598'],
            ["name" => ["ar" => 'أوزبكستان', "en" => 'Uzbekistan', "fr" => 'Ouzbékistan', "ku" => 'ئوزبەکستان'], 'country_code' => 'UZ', 'phone_code' => '998'],
            ["name" => ["ar" => 'فنزويلا', "en" => 'Venezuela', "fr" => 'Venezuela', "ku" => 'فنزویلا'], 'country_code' => 'VE', 'phone_code' => '58'],
            ["name" => ["ar" => 'فيتنام', "en" => 'Vietnam', "fr" => 'Vietnam', "ku" => 'فیتنام'], 'country_code' => 'VN', 'phone_code' => '84'],
            ["name" => ["ar" => 'زامبيا', "en" => 'Zambia', "fr" => 'Zambie', "ku" => 'زامبیا'], 'country_code' => 'ZM', 'phone_code' => '260'],
            ["name" => ["ar" => 'زيمبابوي', "en" => 'Zimbabwe', "fr" => 'Zimbabwe', "ku" => 'زیمبابوی'], 'country_code' => 'ZW', 'phone_code' => '263'],
        ];

        foreach ($countries as $country) {

            $created_country = Country::create($country);

        }

    }

    private function deleteKey($array, $key)
    {
        unset($array[$key]);
        return $array;
    }
}
