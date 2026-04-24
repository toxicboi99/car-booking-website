<?php $browserActions = pullBrowserActions(); ?>
        </main>
    </div>
    <?php if ($browserActions): ?>
        <script>
            (() => {
                const actions = <?php echo json_encode($browserActions, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

                actions.forEach((action) => {
                    if (!action || typeof action !== "object") {
                        return;
                    }

                    if (action.type === "open_url" && action.url) {
                        const popup = window.open(action.url, "_blank");
                        if (!popup || popup.closed || typeof popup.closed === "undefined") {
                            window.location.href = action.url;
                        }
                        return;
                    }

                    if (action.type === "alert" && action.message) {
                        window.alert(action.message);
                    }
                });
            })();
        </script>
    <?php endif; ?>
</body>
</html>
