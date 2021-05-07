"use strict";

let gulp = require("gulp");
let sass = require("gulp-sass");
let autoprefixer = require("gulp-autoprefixer");
let cleanCSS = require("gulp-clean-css");
let sassGlob = require("gulp-sass-glob");
let del = require("del");
let sourcemaps = require("gulp-sourcemaps");
let uglify = require("gulp-uglify");
let rename = require("gulp-rename");
let merge = require("merge-stream");
let webpackStream = require("webpack-stream");
const webpack = require("./webpack.config");

const config = {
  hostName: "localhost",
  browser: "google chrome", // set chrome in windows
  watch: {
    sass: ["./resources/sass/**/*.sass", "./resources/sass/**/*.scss"],
    js: ["./resources/js/**/**/*.js", "./resources/js/**/**/*.vue"],
  },
  path: {
    sass: {
      src: ["./resources/sass/front.sass"],
      dest: "./public/css",
    },
  },
  cleanDel: ["./public/js", "./public/css"],
};


gulp.task("watch", (done) => {
  gulp.watch(config.watch.sass, gulp.series("sass"));
  gulp.watch(config.watch.js, gulp.series("webpack"));
});

gulp.task("sass", (done) => {
  return gulp
    .src(config.path.sass.src)
    .pipe(sourcemaps.init())
    .pipe(sassGlob())
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(cleanCSS())
    .pipe(sourcemaps.write("./"))
    .pipe(gulp.dest(config.path.sass.dest));
});

gulp.task("webpack", (done) => {
  return gulp
    .src("./resources/js/front/vue.js")
    .pipe(webpackStream(webpack))
    .pipe(gulp.dest("./public/js"));
});


gulp.task("clean", (done) => {
  return del(config.cleanDel);
});

gulp.task("build-resources-modules", (done) => {
  return merge(
    gulp
      .src(config.path.js.src)
      .pipe(uglify())
      .pipe(gulp.dest(config.path.js.dest)),
    gulp
      .src(config.path.css.src)
      .pipe(cleanCSS())
      .pipe(gulp.dest(config.path.css.dest))
  );
});

gulp.task("default", gulp.parallel("watch"));
gulp.task(
  "build",
  gulp.series(
    "clean",
    "sass",
    "webpack",
    gulp.parallel("build-resources-modules")
  )
);
