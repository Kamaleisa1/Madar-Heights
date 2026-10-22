# موقع مدار هايتس — Madar Heights

موقع شركة **مدار هايتس** للتنظيف وغسيل الخزانات ومكافحة الحشرات وغسيل المكيفات
في الدمام والقطيف وسيهات والأحساء والجبيل.

مبني بـ **PHP 8.3 + Laravel 13**، ولوحة تحكم **Filament 5** على `/admin`. قاعدة البيانات MySQL، وبدون npm/Vite. ملفات CSS و JS جاهزة في `public/assets`.

## المميزات
- الموقع **عربي وإنجليزي**: العربي على `/` والإنجليزي على `/en`، وفيه زر للتبديل في الهيدر.
- الوضع النهاري هو الأساسي، وفيه زر في الهيدر للتحويل للوضع الليلي، والموقع بيحفظ اختيار الزائر.
- الهوية البصرية مأخوذة من اللوجو: أزرق ملكي + أصفر دهبي + فضي.
- زر **اطلب الخدمة** باللون الرصاصي في كل الموقع.
- موشن جرافيكس: شاشة تحميل، فقاعات متحركة، مدار دوّار في الهيرو، كتابة متحركة، شريط خدمات متحرك،
  ظهور العناصر مع السكرول، عدادات أرقام، كروت فيها ميلان ثلاثي الأبعاد، سلايدر آراء العملاء، أزرار واتساب واتصال عائمة.
- 12 خدمة (منها الجديدة: غسيل الخزانات الأرضية، غسيل الخزانات العلوية، مكافحة الحشرات، غسيل المكيفات).
- صفحة لكل مدينة: الدمام، القطيف، سيهات، الأحساء، الجبيل.
- نموذج طلب الخدمة بيبعت الطلب على واتساب `+966 57 925 5992` برسالة جاهزة، وبيحفظ نسخة في `storage/logs/bookings.log`.
- صفحات مقالات، خريطة موقع `sitemap.xml`، وبيانات SEO.

## لوحة التحكم (`/admin`)
- تسجيل دخول بالإيميل وكلمة المرور، وكل المستخدمين ليهم صلاحيات كاملة.
- **طلبات الخدمة:** كل طلب من نموذج الموقع بيتسجل هنا، ومعاه حالة المتابعة. وبيتبعت إيميل للعناوين المكتوبة في إعدادات الموقع.
- **الخدمات، المدن، آراء العملاء، الأسئلة الشائعة، المدونة:** إضافة وتعديل وحذف وترتيب بالسحب، بالعربي والإنجليزي.
- **إعدادات الموقع:** التواصل، السوشيال، سيكشن الخصم، الأرقام، لماذا نحن، خطوات العمل، صورة "من نحن".
- **نصوص الموقع:** كل العناوين والأزرار الثابتة بالعربي والإنجليزي.
- الصور المرفوعة من اللوحة بتتحفظ في `public/uploads/`. **ما تمسحش الفولدر ده** وانت بتحدّث الموقع.
- لو قاعدة البيانات مش متوصلة، الموقع بيعرض المحتوى الأصلي من الملفات وما بيقعش.

إضافة مستخدم من SSH: `php artisan make:filament-user`
نقل المحتوى الأصلي لقاعدة البيانات (مرة واحدة، وبيكمل الناقص بس): `php artisan db:seed --force`

## تعديل المحتوى من الكود (المحتوى الافتراضي)
- المحتوى العربي (والأرقام والروابط): **`config/site.php`**
- المحتوى الإنجليزي: **`config/site_en.php`** (نفس المفاتيح، وعدد العناصر في القوائم لازم يكون زي العربي)
- كلام الواجهة (الأزرار والعناوين) بالإنجليزي: **`lang/en.json`**
- صورة الخصم: `public/assets/img/offer.jpg` (عربي) و `offer-en.jpg` (إنجليزي)
- صور آراء العملاء: `public/assets/img/reviews/`

### روابط السوشيال ميديا
موجودة في `config/site.php` تحت `social` (فيسبوك، إنستجرام، تيك توك).

### الألوان
ألوان الوضعين في أول ملف `public/assets/css/app.css` (`[data-theme="light"]` و `[data-theme="dark"]`).
لون زر "اطلب الخدمة": المتغيرات `--order-bg` و `--order-bg-hover`.

### اللوجو
ملفات اللوجو في `public/assets/img/`: `logo.webp/png` للخلفيات الفاتحة و `logo-dark.webp/png` للخلفيات الغامقة (الكتابة العربي فيه بيضا).
أيقونة المتصفح: `public/favicon.ico` و `public/favicon.png` و `public/apple-touch-icon.png`.

## الرفع على Hostinger

### الطريقة 1 (المفضلة) — عن طريق SSH
1. من hPanel: **Advanced → PHP Configuration** واختار PHP **8.3** أو أحدث.
2. فعّل SSH من **Advanced → SSH Access** وادخل على السيرفر.
3. ```bash
   cd ~/domains/YOUR-DOMAIN
   git clone https://github.com/kamaleisa1/Madar-Heights.git madar
   cd madar
   composer install --no-dev --optimize-autoloader
   cp .env.example .env
   php artisan key:generate
   ```
4. عدّل `.env`: `APP_ENV=production` و `APP_DEBUG=false` و `APP_URL=https://YOUR-DOMAIN`.
5. اربط مجلد `public` بـ `public_html`:
   ```bash
   cd ~/domains/YOUR-DOMAIN
   mv public_html public_html_old
   ln -s madar/public public_html
   ```
6. ```bash
   cd madar
   php artisan config:cache && php artisan route:cache && php artisan view:cache
   ```

### الطريقة 2 — رفع ملفات بدون SSH
1. على جهازك شغّل `composer install --no-dev --optimize-autoloader` عشان يتعمل مجلد `vendor`.
2. اعمل ملف `.env` من `.env.example` وحط فيه `APP_KEY` (تقدر تولده بـ `php artisan key:generate --show`).
3. اضغط المشروع كله (ومعاه `vendor` و `.env`) ZIP وارفعه في `public_html` من File Manager وفك الضغط.
4. ملف `.htaccess` الموجود في جذر المشروع هيحوّل الزوار تلقائياً لمجلد `public`.
5. تأكد إن مجلدي `storage` و `bootstrap/cache` صلاحياتهم 755 (أو 775).

## التشغيل محلياً
```bash
composer install
cp .env.example .env && php artisan key:generate
php artisan serve
php artisan test
```
