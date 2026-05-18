const fs = require('fs');
const path = require('path');

const MAP = {
    'تسجيل الدخول': 'Sign In',
    'تسجيل الخروج': 'Sign Out',
    'مرحباً بعودتك': 'Welcome back',
    'سجّل الدخول إلى حسابك في Arts Of Code': 'Sign in to your Arts Of Code account',
    'البريد الإلكتروني': 'Email address',
    'كلمة المرور': 'Password',
    'تذكرني': 'Remember me',
    'هل نسيت كلمة المرور؟': 'Forgot password?',
    'لا تملك حساباً؟': "Don't have an account?",
    'إنشاء حساب →': 'Create one →',
    'إنشاء حساب': 'Create one',
    'تسجيل': 'Register',
    'بحث': 'Search',
    'لوحة التحكم': 'Dashboard',
    'المستخدمين': 'Users',
    'المقالات': 'Articles',
    'التصنيفات': 'Categories',
    'الاختبارات': 'Exams',
    'الأسئلة': 'Questions',
    'النتائج': 'Results',
    'إرسال': 'Submit',
    'حفظ': 'Save',
    'إلغاء': 'Cancel',
    'الإجراءات': 'Actions',
    'مقال جديد': 'New Article',
    'عرض': 'Show',
    'قائمة': 'Index',
    'الرئيسية': 'Home',
    'الإعدادات': 'Settings',
    'إنشاء': 'Create',
    'تعديل': 'Edit',
    'تحديث': 'Update',
    'رجوع': 'Back',
    'هل أنت متأكد؟': 'Are you sure?'
};

function escapeRegExp(s) { return s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); }

function translateText(text) {
    let out = text;
    for (const [ar, en] of Object.entries(MAP)) {
        const re = new RegExp(escapeRegExp(ar), 'g');
        out = out.replace(re, en);
    }
    return out;
}

function processFile(filePath) {
    try {
        let txt = fs.readFileSync(filePath, 'utf8');
        let newTxt = txt;

        // placeholders, titles, aria-label
        newTxt = newTxt.replace(/(placeholder=")(.*?)(")/g, (m, p1, inner, p3) => `${p1}${translateText(inner)}${p3}`);
        newTxt = newTxt.replace(/(title=")(.*?)(")/g, (m, p1, inner, p3) => `${p1}${translateText(inner)}${p3}`);
        newTxt = newTxt.replace(/(aria-label=")(.*?)(")/g, (m, p1, inner, p3) => `${p1}${translateText(inner)}${p3}`);

        // visible text between tags
        newTxt = newTxt.replace(/>([^<>\n]+)</g, (m, p1) => {
            const trimmed = p1.trim();
            if (!trimmed) return m;
            const translated = translateText(trimmed);
            if (translated === trimmed) return m;
            return '>' + p1.replace(trimmed, translated) + '<';
        });

        if (newTxt !== txt) {
            fs.writeFileSync(filePath + '.bak', txt, 'utf8');
            fs.writeFileSync(filePath, newTxt, 'utf8');
            console.log('updated', filePath);
        }
    } catch (e) {
        console.error('err', filePath, e.message);
    }
}

function walkDir(dir, callback) {
    fs.readdirSync(dir, { withFileTypes: true }).forEach(dirent => {
        const full = path.join(dir, dirent.name);
        if (dirent.isDirectory()) walkDir(full, callback);
        else callback(full);
    });
}

const args = process.argv.slice(2);
if (args.length === 0) {
    walkDir('resources/views', (f) => { if (f.endsWith('.blade.php')) processFile(f); });
} else {
    args.forEach(processFile);
}
