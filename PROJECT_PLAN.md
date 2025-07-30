# خطة مشروع إدارة المشروعات البرمجية
## Software Project Management System Plan

---

## 🎯 **نظرة عامة على المشروع**

**الهدف:** تطوير تطبيق Laravel لإدارة المشروعات البرمجية باستخدام منهجية Agile

**المسار:** `C:\wamp64\www\administration\projects\`

**التاريخ:** 30 يوليو 2025

---

## 📋 **متطلبات المشروع**

### **1. نوع المشروعات:**
- مشروعات برمجية فقط
- تطبيق منهجية Agile في التطوير

### **2. مراحل تطوير البرمجيات (SDLC):**
```
Phase 1: Analysis (تحليل)
Phase 2: Design (تصميم)
Phase 3: Development (تطوير)
Phase 4: Testing (اختبار)
Phase 5: Deployment (إطلاق)
Phase 6: Maintenance (صيانة/طلبات تعديل)
```

### **3. مستويات المستخدمين (5 مستويات):**
```
Level 1: App Administrators (مديرو التطبيق)
         - إدارة كاملة للتطبيق
         - إعدادات النظام العامة
         - إدارة جميع المستخدمين

Level 2: Administrative Staff (الموظفون الإداريون)
         - إدارة المشروعات
         - تخصيص المهام
         - متابعة التقارير

Level 3: Developers & Mentors (المطورون والمنتورز)
         - تكوين وإدارة الفرق
         - تنفيذ المهام
         - تقديم التوجيه والإرشاد

Level 4: Clients (العملاء)
         - عرض تقدم المشروعات
         - تقديم المتطلبات والتعليقات
         - متابعة المواعيد النهائية

Level 5: Third Party/Interns (طرف ثالث/متدربين)
         - وصول محدود ومؤقت
         - مهام محددة
         - إشراف مباشر
```

### **4. التقنيات المستخدمة:**
- **Framework:** Laravel 11 (الأكثر استقراراً)
- **Database:** MySQL
- **Frontend:** Blade Templates + Bootstrap 5
- **JavaScript:** Ajax Requests + Bootstrap Toaster
- **Icons:** Font Awesome
- **Languages:** Arabic (RTL) + English (LTR)
- **Permissions:** Spatie Laravel Permission
- **Architecture:** MVC Pattern

---

## 🎨 **دليل التصميم والواجهات (UI/UX Guidelines)**

### **1. نظام الألوان:**
```css
Primary Colors:
├── Primary: الفيروزي (Teal/Turquoise) - على خلفيات فاتحة
├── Background: الرمادي الخفيف بدرجاته
├── Headers/Cards: عكس الألوان (فيروزي داكن على فاتح)

Bootstrap Colors (بدرجات أقل - 3 مستويات):
├── Success: درجة أقل من Bootstrap Success الأصلي
├── Warning: درجة أقل من Bootstrap Warning الأصلي
├── Info: درجة أقل من Bootstrap Info الأصلي
├── Danger: درجة أقل من Bootstrap Danger الأصلي

CSS Variables:
:root {
  --bs-primary: #20c997;        /* Teal/Turquoise */
  --bs-primary-rgb: 32, 201, 151;
  --bs-success-light: #d1ecf1;  /* Success مخفف */
  --bs-warning-light: #fff3cd;  /* Warning مخفف */
  --bs-info-light: #d6f9ff;     /* Info مخفف */
  --bs-danger-light: #f8d7da;   /* Danger مخفف */
}
```

### **2. تصميم النماذج (Forms):**
```
Modal Forms:
├── الشاشات الواسعة: 500px - 800px
├── التابلت: 500px - 800px  
├── الهواتف: عرض الشاشة الكامل (100%)
├── العمليات: إنشاء، تعديل، حذف (كلها في Modals)

Responsive Breakpoints:
├── Desktop: 800px max-width
├── Tablet: 500px min-width, 800px max-width
├── Mobile: 100% width (full screen)
```

### **3. عناصر الواجهة:**
```
Form Elements:
├── Text & Select Fields: .input-group
├── Textarea: Floating Labels
├── Checkboxes & Radios: Switch Mode
├── Validation Messages: أسفل الحقول المخالفة
├── Success/Error Messages: Bootstrap Toaster (يمين/يسار حسب اللغة)

Language & Direction Support:
├── Arabic: RTL (Right-to-Left)
├── English: LTR (Left-to-Right)
├── Toaster Position: يتكيف مع اتجاه اللغة
```

### **4. هيكل الصفحة:**
```
Layout Structure:
├── Sidebar: قوائم الموديولات الأساسية
│   ├── المشاريع (collapse/expand)
│   │   ├── المشاريع الجديدة
│   │   ├── المشاريع الجارية
│   │   └── المشاريع المكتملة
│   ├── الفرق (collapse/expand)
│   │   ├── إدارة الفرق
│   │   ├── تخصيص المهام
│   │   └── تقييم الأداء
│   └── Bootstrap Collapse للقوائم المتفرعة
│
├── Top Navigation:
│   ├── Breadcrumb (مسار الصفحة الحالية)
│   ├── نموذج البحث العام
│   └── روابط المستخدم المسجل
│
└── Content Area: المحتوى الرئيسي
```

### **5. الرموز والأيقونات:**
```
Font Awesome Icons Usage:
├── الأزرار والروابط
├── Labels بجوار حقول الإدخال
├── رؤوس الأعمدة في الجداول
├── ترويسات الأقسام
├── عناصر القوائم الجانبية
├── مؤشرات الحالة (Status Indicators)
└── أزرار العمليات (CRUD Operations)

Icon Classes Examples:
├── fa-solid fa-plus (إضافة)
├── fa-solid fa-edit (تعديل)
├── fa-solid fa-trash (حذف)
├── fa-solid fa-eye (عرض)
└── fa-solid fa-cog (إعدادات)
```

---

## 📦 **الحزم والمكتبات المطلوبة (Required Packages)**

### **Laravel Packages:**
```bash
# Authentication & Permissions
composer require spatie/laravel-permission

# Localization Support  
composer require mcamara/laravel-localization

# Form Validation (Arabic)
composer require astrotomic/laravel-translatable
```

### **Frontend Libraries:**
```bash
# Bootstrap 5 (already included in Laravel)
# Font Awesome
npm install @fortawesome/fontawesome-free

# Bootstrap Toast (built-in with Bootstrap 5)
# RTL Support CSS
```

### **Configuration Files:**
```php
// config/app.php - Languages
'locales' => ['en', 'ar'],
'fallback_locale' => 'en',

// Spatie Permission
'permission' => [
    'models' => [
        'permission' => Spatie\Permission\Models\Permission::class,
        'role' => Spatie\Permission\Models\Role::class,
    ],
],
```

---

## 🏗️ **مراحل التطوير**

### **Phase 1: Project Foundation (الأساس)**
**المدة المتوقعة:** 1-2 أسابيع

**المهام:**
- [ ] إنشاء مشروع Laravel 11
- [ ] إعداد قاعدة البيانات MySQL
- [ ] تثبيت Spatie Laravel Permission
- [ ] تثبيت Laravel Localization (Arabic/English)
- [ ] تصميم نظام المصادقة (Authentication)
- [ ] إنشاء نظام الأدوار والصلاحيات (5 مستويات)
- [ ] إعداد Bootstrap 5 + Font Awesome
- [ ] تطبيق نظام الألوان المخصص (Teal Primary)
- [ ] إعداد RTL/LTR Support
- [ ] إعداد Layout الرئيسي (Sidebar + Top Navigation)
- [ ] تكوين Bootstrap Toaster للإشعارات
- [ ] إعداد Ajax Requests Structure + CSRF
- [ ] تطبيق Collapse للقوائم الجانبية

**التسليمات:**
- مشروع Laravel جاهز للتطوير
- نظام تسجيل دخول متعدد المستويات
- واجهة إدارة أساسية

### **Phase 2: User Management & Permissions (إدارة المستخدمين والصلاحيات)**
**المدة المتوقعة:** 3-4 أسابيع
**الأولوية:** **عالية جداً** - يجب إكمالها قبل أي وحدة أخرى

**المهام:**

**أ) واجهات المستخدمين (User Interfaces):**
- [ ] 1. تسجيل الدخول (Login) ✅ **مكتمل**
- [ ] 2. استعادة كلمة المرور (Password Recovery) ✅ **مكتمل**
- [ ] 3. إعادة ضبط كلمة المرور (Password Reset) ✅ **مكتمل**
- [ ] 4. الملف الشخصي (Profile Management)
- [ ] 5. تسجيل الخروج (Logout) ✅ **مكتمل**
- [ ] 6. التسجيل في التطبيق للمستخدمين العاديين (User Self-Registration)
- [ ] 7. تسجيل المستخدمين من قبل الإدارة (Admin User Creation)
- [ ] 8. تفعيل/تنشيط حساب المستخدم (User Account Activation)
- [ ] 9. عرض جميع المستخدمين مع التبويب حسب الفئات (Users Management Dashboard)
  - [ ] تبويب: جميع المستخدمين
  - [ ] تبويب: مديرو التطبيق (App Administrators)
  - [ ] تبويب: الموظفون الإداريون (Administrative Staff)
  - [ ] تبويب: المطورون والمنتورز (Developers & Mentors)
  - [ ] تبويب: العملاء (Clients)
  - [ ] تبويب: طرف ثالث/متدربين (Third Party/Interns)
  - [ ] تبويب: بانتظار الموافقة/التنشيط (Pending Activation)

**ب) إدارة الأدوار والصلاحيات (Roles & Permissions Management):**
- [ ] 1. تعيين دور أو أكثر لكل مستخدم (Assign Multiple Roles to Users)
- [ ] 2. تعيين/إزالة الصلاحيات للأدوار (Assign/Remove Permissions to/from Roles)
- [ ] 3. إدارة الأدوار (Roles Full CRUD)
- [ ] 4. إدارة الصلاحيات (Permissions Full CRUD)
- [ ] 5. تعيين صلاحيات خاصة لمستخدم (Direct User Permissions)
- [ ] 6. عرض أدوار المستخدم وصلاحياته (User Roles & Permissions Overview)

**التفريق بين نوعي التسجيل:**
```
النوع الأول: التسجيل الذاتي (Self-Registration)
├── المستخدم يسجل بنفسه
├── الحساب يكون غير مفعل (pending activation)
├── الإدارة تراجع وتفعل الحساب
└── يتم تخصيص الدور بعد التفعيل

النوع الثاني: إضافة إدارية (Admin Creation)
├── الإدارة تنشئ الحساب مباشرة
├── تحديد الدور والصلاحيات فوراً
├── الحساب مفعل افتراضياً
└── إرسال بيانات الدخول للمستخدم
```

**التسليمات:**
- نظام إدارة مستخدمين متكامل
- نظام أدوار وصلاحيات مرن ومتقدم
- واجهات إدارية شاملة للتحكم في المستخدمين
- تفعيل المستخدمين وإدارة حالاتهم

### **Phase 3: Core Modules (الوحدات الأساسية)**
**المدة المتوقعة:** 3-4 أسابيع
**ملاحظة:** يتم البدء فيها فقط بعد إكمال Phase 2 بالكامل

**المهام:**
- [ ] إدارة المشروعات (Projects Management)
- [ ] تتبع مراحل SDLC
- [ ] تكوين الفرق (Teams Formation)
- [ ] إدارة العملاء (Client Management)

**التسليمات:**
- نموذج بيانات كامل للمشروعات
- واجهات إدارة الفرق
- نظام تتبع مراحل التطوير

### **Phase 3: Agile Features (ميزات الأجايل)**
**المدة المتوقعة:** 4-5 أسابيع

**المهام:**
- [ ] إدارة Backlogs
- [ ] بناء WBS (Work Breakdown Structure)
- [ ] تخطيط Sprints
- [ ] إدارة User Stories
- [ ] تخصيص المهام للفرق
- [ ] متابعة تقدم المهام

**التسليمات:**
- نظام إدارة Backlogs متكامل
- أداة بناء WBS تفاعلية
- لوحة تحكم Agile

### **Phase 4: Advanced Features (ميزات متقدمة)**
**المدة المتوقعة:** 3-4 أسابيع

**المهام:**
- [ ] تتبع الوقت (Time Tracking)
- [ ] نظام التقارير والإحصائيات
- [ ] بوابة العملاء (Client Portal)
- [ ] نظام الإشعارات
- [ ] تكامل مع أدوات خارجية (APIs)

**التسليمات:**
- نظام تقارير شامل
- بوابة عملاء مستقلة
- نظام إشعارات متقدم

---

## 🗄️ **هيكل قاعدة البيانات المقترح**

```sql
Core Tables:
├── users (المستخدمون)
├── roles (الأدوار)
├── permissions (الصلاحيات)
├── role_user (ربط المستخدمين بالأدوار)

Project Management:
├── projects (المشروعات)
├── project_phases (مراحل المشروع)
├── teams (الفرق)
├── team_members (أعضاء الفرق)

Agile Management:
├── backlogs (قوائم المهام المعلقة)
├── user_stories (قصص المستخدم)
├── sprints (السبرنتات)
├── tasks (المهام)
├── task_assignments (تخصيص المهام)

Time & Progress:
├── time_tracking (تتبع الوقت)
├── progress_reports (تقارير التقدم)
├── milestones (المعالم)

Client Management:
├── clients (العملاء)
├── client_feedback (تعليقات العملاء)
├── change_requests (طلبات التغيير)
```

---

## 🎯 **الأهداف الذكية (SMART Goals)**

### **للمطورين:**
- تحسين إنتاجية الفرق بنسبة 30%
- تقليل وقت التسليم بنسبة 25%
- زيادة جودة الكود من خلال المراجعة المنتظمة

### **للعملاء:**
- شفافية كاملة في تتبع المشروعات
- سرعة في الاستجابة لطلبات التغيير
- تحسين رضا العملاء

### **للإدارة:**
- تقارير دقيقة عن أداء الفرق
- متابعة الميزانيات والتكاليف
- اتخاذ قرارات مبنية على البيانات

---

## 📊 **مؤشرات الأداء الرئيسية (KPIs)**

1. **معدل إنجاز المهام**
2. **الالتزام بالمواعيد النهائية**
3. **جودة التسليمات**
4. **رضا العملاء**
5. **كفاءة استخدام الموارد**

---

## 🔄 **منهجية التطوير**

### **Agile Methodology:**
- **Sprint Duration:** 2 أسابيع
- **Daily Standups:** اجتماعات يومية سريعة
- **Sprint Review:** مراجعة نهاية كل سبرنت
- **Retrospective:** تقييم ما تم وما يحتاج تحسين

### **Tools Integration:**
- Git للتحكم في الإصدارات
- Docker للنشر
- Testing Framework للاختبارات الآلية

---

## 🚀 **الخطوات التالية**

1. **إنشاء المشروع:** `composer create-project laravel/laravel projects "11.*"`
2. **إعداد البيئة المحلية**
3. **تصميم قاعدة البيانات التفصيلية**
4. **إنشاء النماذج الأولية (Prototypes)**

---

## 📝 **ملاحظات إضافية**

- **Security:** تطبيق أفضل ممارسات الأمان
- **Scalability:** قابلية التوسع لاستيعاب مشروعات أكبر
- **Documentation:** توثيق شامل للكود والعمليات
- **Testing:** اختبارات شاملة لضمان الجودة

---

**آخر تحديث:** 30 يوليو 2025
**المسؤول عن المشروع:** فريق التطوير
**حالة المشروع:** في مرحلة التخطيط
