<?= $this->extend('web/layouts/main_layout') ?>

<?= $this->section('body-contents') ?>
<div class="wrapper_home">
    <!-- <div class="content_rank" style="padding:20px;text-align:center;">
        <h5>Votre avis sur le produit : <?= $single['product_title'] ?></h5>

        <form class="rating rating2">
            <a class="bone" href="#5" data-rank="5" title="Give 5 stars"><i class="fas fa-bone"></i></a>
            <a class="bone" href="#4" data-rank="4" title="Give 4 stars"><i class="fas fa-bone"></i></a>
            <a class="bone" href="#3" data-rank="3" title="Give 3 stars"><i class="fas fa-bone"></i></a>
            <a class="bone" href="#2" data-rank="2" title="Give 2 stars"><i class="fas fa-bone"></i></a>
            <a class="bone" href="#1" data-rank="1" title="Give 1 star"><i class="fas fa-bone"></i></a>
        </form>
        <span id="text_rank"></span>
    </div> -->


    <div class="profile-body">
        <div class="photo">
            <img src="<?= base_url('public/uploads/' . $single['product_image']) ?>" class="image--cover">
        </div>
        <div class="profile">
            <h5>Votre avis sur le produit : <?= $single['product_title'] ?></h5>


            <div id="rating-stars" style="text-align:center;">
                <div class="stars">
                    <label aria-label="first-star" class="star-label" for="rate-1" data-rank="1"><i class="rate-icon star-icon fa fa-bone"></i></label>
                    <input class="rate-input" name="rating" id="rate-1" value="1" type="radio">
                    <label aria-label="second-star" class="star-label" for="rate-2" data-rank="2"><i class="rate-icon star-icon fa fa-bone"></i></label>
                    <input class="rate-input" name="rating" id="rate-2" value="2" type="radio">
                    <label aria-label="third-star" class="star-label" for="rate-3" data-rank="3"><i class="rate-icon star-icon fa fa-bone"></i></label>
                    <input class="rate-input" name="rating" id="rate-3" value="3" type="radio">
                    <label aria-label="fourth-star" class="star-label" for="rate-4" data-rank="4"><i class="rate-icon star-icon fa fa-bone"></i></label>
                    <input class="rate-input" name="rating" id="rate-4" value="4" type="radio">
                    <label aria-label="fifth-star" class="star-label" for="rate-5" data-rank="5"><i class="rate-icon star-icon fa fa-bone"></i></label>
                    <input class="rate-input" name="rating" id="rate-5" value="5" type="radio">
                    <span id="rank_value" style="display:none"></span>
                </div>
                <p id="text_rank" class="purple-text"></p>

            </div>
            <br><br>
            <input id='title_rank' style="outline:none;border:1px solid grey; width:60%;margin:0 auto;display:block;text-align:center" placeholder='titre' />
            <br>
            <textarea id="comment" style="height:150px;width:60%;padding:15px;outline:none;resize:none;border-radius:2px;text-align:center" placeholder="Laissez un commentaire(facultatif)"></textarea><br>
            <button type="button" class='btn-small purple' id='submit_comment'>Valider</button>
        </div>

        <script>
            var bone = document.querySelectorAll('.star-label')
            var rank_value = document.querySelector('#rank_value')



            bone.forEach(item => {
                item.addEventListener('click', checkedClicked)
            });

            function checkedClicked() {

                dataRank = this.dataset.rank;
                console.log(dataRank)

                $('#rank_value').html(dataRank)
                $('#text_rank').html('Merci! Votre évaluation est <span style="font-size:20px;">' + dataRank + '</span>/5');

                $(document).on('click', '#submit_comment', function() {
                    $.ajax({
                        url: '<?= base_url('ajax_comment_datas') ?>',
                        type: 'POST',
                        data: {
                            rank: dataRank,
                            title: $('#title_rank').val(),
                            comment: $('#comment').val(),
                            product_id: <?= $single['product_id'] ?>
                        },
                        datatype: 'JSON',
                        success: function(response) {
                            var msg_response = JSON.parse(response)
                            $('#text_rank').html(msg_response.msg)
                        }
                    });
                });
            }
        </script>

        <style>
            .profile-body {
                margin: 25px;
            }

            .profile {
                margin-top: -45px;
                margin-left: auto;
                margin-right: auto;
                border-radius: 25px;
                padding: 20px;
                z-index: 0;
                text-align: center;
            }

            .photo {
                margin: 25px;
            }

            .image--cover {
                width: 170px;
                height: 170px;
                border: #fff 3px solid;
                border-radius: 50%;
                object-fit: cover;
                object-position: center;
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: auto;
                margin-top: -40px;
            }

            #rating-stars {
                margin: 4px;

            }


            #rarate-input {
                pointer-events: none;
            }

            #rating-stars .rate-input {
                position: absolute;
                left: -9999px;
            }

            #rating-stars label {
                cursor: pointer;
                padding: 1px;
                font-size: 20pt;
            }

            #rating-stars .star-icon {
                color: orange;
                display: inline-flex;
                transform: rotate(135deg);

            }

            #rating-stars .rate-input:checked~.star-label .star-icon {
                color: #999;
            }

            #rating-stars .stars:hover .star-label .star-icon {
                color: orange;
            }

            #rating-stars .rate-input:hover~.star-label .star-icon {
                color: #999;
            }
        </style>
        <?= $this->endSection() ?>