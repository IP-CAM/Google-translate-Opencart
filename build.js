const fs = require('fs');
const archiver = require('archiver');
fs.mkdirSync('build', { recursive: true });

const archive = archiver('zip');

archive.directory('src', false);
archive.finalize();

archive.pipe(fs.createWriteStream('build/google_translate.ocmod.zip'));
